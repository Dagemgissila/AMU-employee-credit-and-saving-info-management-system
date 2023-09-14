<?php

namespace App\Http\Controllers\Manager;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Credit;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\CreditPayment;
use App\Models\RequestCredit;
use App\Models\SavingAccount;
use Illuminate\Validation\Rule;
use Faker\Provider\zh_TW\Payment;
use App\Http\Controllers\Controller;
use App\Notifications\CreditApproved;

class CreditController extends Controller
{
    public function index(){
        if(auth()->user()->password_status == 0){
            return redirect()->route('manager.changepassword');
        }

        $members=Member::all();

        return view('manager.ManageLoan.addcredit',compact('members'));
    }

    public function addcredit(Request $request){
        $this->validate($request, [
            'username' => [
                'required',
                'exists:users,username'
            ],
            'witness_1' => [
                'nullable',
                'exists:users,username',
                Rule::notIn([$request->username])
            ],
            'witness_2' => [
                 'nullable',
                'exists:users,username',
                Rule::notIn([$request->username]),
                Rule::notIn([$request->witness_1])
            ],
            'credit_amount' => 'required',
            'credit_duration' => 'required|min:1',
            'credit_start' => 'required|date',
        ], [
            'witness_1.not_in' => 'The member cannot be a witness for themselves.',
            'witness_2.not_in' => 'Please select different Witness 2 from witness 1 or From Member username.'
        ]);



         //for member who apply credit
         $user=User::where('username',$request->username)->first();
         $member=Member::where('user_id',$user->id)->first();
         $memberId=$member->id;
         $MemberRegisteredDate=$member->registered_date;
         $MemberSavingAmount=SavingAccount::where('member_id',$memberId)->sum('saving_amount');
         $status=null;

         if( $request->credit_duration <= 12){
            $interestRate =11.5;
         }

         if(($request->credit_duration) > 12 and ($request->credit_duration <= 36) ){
            $interestRate =11;
         }

         if($request->credit_duration >36 ){
            $interestRate =10.5;
         }

         $memberPrevLoan=Credit::query()->where('member_id',$memberId)
           ->orderBy('created_at', 'desc')
          ->first();

       if(  $memberPrevLoan !== null){
           $status=$memberPrevLoan->credit_status;

       }

         //check wether the member has unpaid loan
       if($status === 0){
            return back()->with('error','the members has unpaid loan');
       }



         //for witness 1
       if($request->witness_1){
        $user2=User::where('username',$request->witness_1)->first();
        $witness1=Member::where('user_id',$user2->id)->first();
        $witness1Id=$witness1->id;
        $Witness1SavingAmount=SavingAccount::where('member_id',$witness1Id)->sum('saving_amount');
       }

        //for witness 2
       if($request->witness_2){
        $user3=User::where('username',$request->witness_2)->first();
        $witness2=Member::where('user_id',$user3->id)->first();
        $witness2Id=$witness2->id;
        $Witness2SavingAmount=SavingAccount::where('member_id',$witness2Id)->sum('saving_amount');

       }

        //balance zero case needs to be checked here
              if( $MemberSavingAmount == 0){
                return back()->with('error',"Member can't get Loan with a ZERO BALANCE!");
              }


         //calculate the difference between months of member registered date and now
         $monthsDifference = Carbon::now()->diffInMonths($MemberRegisteredDate);

         if($monthsDifference < 6){
            return back()->with('error', 'Member must be at least a 6-month stay to be eligible for a loan.');
         }

               //when member requested credit greater than saving amount the witness is required
       if(($request->credit_amount > $MemberSavingAmount) and ((!$request->witness_1) and (!$request->witness_2) )){
        return back()->with('error','Because of Credit Amount Greater than Member Saving Amount Witness Is Required');
       }



        //requested
         $loanAmount =$request->credit_amount;
         $loanTermInMonths = $request->credit_duration;

         $principal = $loanAmount / $loanTermInMonths;
         $creditStartDate = Carbon::parse($request->credit_start)->startOfDay();
         $monthlyInterestRate = ($interestRate / 12) / 100;

         //loan schedule calculation
         $loanSchedule = [];
         $balance = $loanAmount;
         $totalInterest = 0;
         $interestCount = 0;
         for ($i = 1; $i <= $loanTermInMonths; $i++) {
             $interest = $balance * $monthlyInterestRate;//monthly interest
             $dueDate = $creditStartDate->copy()->addMonths($i)->format('m/d/Y');
             $due = $principal + $interest;
             $principalBalance = $balance - $principal;
             $loanSchedule[] = [
                 'due_date' => $dueDate,
                 'principal' => $principal,
                 'interest' =>$interest,
                 'due' => $due,
                 'principal_balance' => $principalBalance,
             ];

             $balance = $principalBalance;
             $totalInterest += $interest;
             $interestCount++;

         }


       //when member saving amount is greater than requested loan amount ... does not need witness
       if ($MemberSavingAmount >= $request->credit_amount) {
        $credit = new Credit();
        $credit->member_id = $memberId;
        $credit->credit_amount = $request->credit_amount;
        $credit->interest_rate = $interestRate;
        $credit->interest_amount = $totalInterest;
        $credit->duration_in_month=$request->credit_duration;
        $credit->total_payment = $loanAmount + array_sum(array_column($loanSchedule, 'interest'));
        $credit->credit_start = $request->credit_start;
        $credit->credit_end = Carbon::createFromFormat('m/d/Y', $dueDate)->format('Y-m-d');
        $credit->save();

        $loanAmount = $request->credit_amount;
        $loanTermInMonths = $request->credit_duration;
        $principal = $loanAmount / $loanTermInMonths;
        $creditStartDate = Carbon::parse($request->credit_start)->startOfDay();
        $monthlyInterestRate = ($interestRate / 12) / 100;

        // Prepare loan schedule data
        $loanSchedule = [];
        $balance = $loanAmount;
        $totalInterest = 0;

        for ($i = 1; $i <= $loanTermInMonths; $i++) {
            $interest = $balance * $monthlyInterestRate; // Monthly interest
            $dueDate = $creditStartDate->copy()->addMonths($i)->format('m/d/Y');
            $due = $principal + $interest;
            $principalBalance = $balance - $principal;
            $loanSchedule[] = [
                'due_date' => $dueDate,
                'principal' => $principal,
                'interest' => $interest,
                'due' => $due,
                'principal_balance' => $principalBalance,
            ];

            $balance = $principalBalance;
            $totalInterest += $interest;
        }


        // Insert loan schedule data into the database
        $creditPayments = [];
        foreach ($loanSchedule as $schedule) {
            $creditPayments[] = [
                'credit_id' => $credit->id,
                'paid_amount' => $schedule['due'],
                'interest' => $schedule['interest'],
                'principal_balance' => $schedule['principal_balance'],
                'principal' => $schedule['principal'],
                'paid_month' => Carbon::createFromFormat('m/d/Y', $schedule['due_date'])->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        CreditPayment::insert($creditPayments);

        return back()->with('message', 'The loan has been successfully given');
    }

           if(($request->witness_1) or ($request->witness_2)){

            if(($request->witness_1) and ($request->witness_2)){

                //
                //requuest witness 1  count ...
                $W1r1=Credit::query()
                ->where('witness1',$request->witness_1)
                ->where('credit_status',0)->count();
                $W2r1=Credit::query()
                ->where('witness2',$request->witness_1)
                ->where('credit_status',0)->count();

                //request witness 2 count
                $W1r2=Credit::query()
                ->where('witness1',$request->witness_2)
                ->where('credit_status',0)->count();

                $W2r2=Credit::query()
                ->where('witness2',$request->witness_2)
                ->where('credit_status',0)->count();


                  //the following code restrict witness if they guarante more than two times
                if(($W1r1 + $W2r1) >= 2){
                    return back()->with('error',$request->witness_1 .' can not be witness for more than 2 members ');
                }


                if(($W1r2 + $W2r2) >= 2){
                    return back()->with('error',$request->witness_2 .' can not be witness for more than 2 members ');
                }

                $maxAllowedLoan=$MemberSavingAmount * 3;
                $witnessTotalSavingAmount=$Witness1SavingAmount + $Witness2SavingAmount;
                if($request->credit_amount > $maxAllowedLoan){

                    return back()->with('error','Member Allowed to Borrow Maximum  ' .$maxAllowedLoan. " Birr");
                }

                else if(($request->credit_amount) > ($witnessTotalSavingAmount + $MemberSavingAmount)){

                    return back()->with('error','Witness have not enough Amount of Money');
                }
                else{

                    $credit=new Credit();
                    $credit->member_id=$memberId;
                    $credit->credit_amount=$request->credit_amount;
                    $credit->interest_rate= $interestRate;
                    $credit->interest_amount=$totalInterest;
                    $credit->total_payment=$loanAmount + array_sum(array_column($loanSchedule, 'interest'));
                    $credit->credit_start=$request->credit_start;
                    $credit->credit_end = Carbon::createFromFormat('m/d/Y', $dueDate)->format('Y-m-d');
                    $credit->witness1=$request->witness_1;
                    $credit->witness2=$request->witness_2;
                    $credit->duration_in_month=$request->credit_duration;
                    $credit->save();

                    $loanAmount = $request->credit_amount;
                    $loanTermInMonths = $request->credit_duration;
                    $principal = $loanAmount / $loanTermInMonths;
                    $creditStartDate = Carbon::parse($request->credit_start)->startOfDay();
                    $monthlyInterestRate = ($interestRate / 12) / 100;

                    // Prepare loan schedule data
                    $loanSchedule = [];
                    $balance = $loanAmount;
                    $totalInterest = 0;

                    for ($i = 1; $i <= $loanTermInMonths; $i++) {
                        $interest = $balance * $monthlyInterestRate; // Monthly interest
                        $dueDate = $creditStartDate->copy()->addMonths($i)->format('m/d/Y');
                        $due = $principal + $interest;
                        $principalBalance = $balance - $principal;
                        $loanSchedule[] = [
                            'due_date' => $dueDate,
                            'principal' => $principal,
                            'interest' => $interest,
                            'due' => $due,
                            'principal_balance' => $principalBalance,
                        ];

                        $balance = $principalBalance;
                        $totalInterest += $interest;
                    }


                    // Insert loan schedule data into the database
                    $creditPayments = [];
                    foreach ($loanSchedule as $schedule) {
                        $creditPayments[] = [
                            'credit_id' => $credit->id,
                            'paid_amount' => $schedule['due'],
                            'interest' => $schedule['interest'],
                            'principal_balance' => $schedule['principal_balance'],
                            'principal' => $schedule['principal'],
                            'paid_month' => Carbon::createFromFormat('m/d/Y', $schedule['due_date'])->format('Y-m-d'),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }

                    CreditPayment::insert($creditPayments);

                    return back()->with('message', 'The loan has been successfully given');
                }
            }
                else if($request->witness_1){
                    $W1r1=Credit::query()
                    ->where('witness1',$request->witness_1)
                    ->where('credit_status',0)->count();
                    $W2r1=Credit::query()
                    ->where('witness2',$request->witness_1)
                    ->where('credit_status',0)->count();

                    //the following code restrict witness if they guarante more than two times
                  if(($W1r1 + $W2r1) >= 2){
                      return back()->with('error',$request->witness_1 .' can not be witness for more than 2 members ');
                  }

                    $maxAllowedLoan=$MemberSavingAmount * 3;
                    $witnessTotalSavingAmount=$Witness1SavingAmount;
                    if($request->credit_amount > $maxAllowedLoan){

                        return back()->with('error','Member Allowed to Borrow Maximum  ' .$maxAllowedLoan. " Birr");
                    }

                    else if(($request->credit_amount) > ($witnessTotalSavingAmount + $MemberSavingAmount)){

                        return back()->with('error','Witness have not enough Amount of Money');
                    }

                    else{

                        $credit=new Credit();
                        $credit->member_id=$memberId;
                        $credit->credit_amount=$request->credit_amount;
                        $credit->interest_rate=$interestRate;
                        $credit->duration_in_month=$request->credit_duration;
                        $credit->interest_amount=$totalInterest;
                        $credit->total_payment=$loanAmount + array_sum(array_column($loanSchedule, 'interest'));
                        $credit->credit_start=$request->credit_start;
                        $credit->credit_end = Carbon::createFromFormat('m/d/Y', $dueDate)->format('Y-m-d');
                        $credit->witness1=$request->witness_1;
                        $credit->save();

                        $loanAmount = $request->credit_amount;
        $loanTermInMonths = $request->credit_duration;
        $principal = $loanAmount / $loanTermInMonths;
        $creditStartDate = Carbon::parse($request->credit_start)->startOfDay();
        $monthlyInterestRate = ($interestRate / 12) / 100;

        // Prepare loan schedule data
        $loanSchedule = [];
        $balance = $loanAmount;
        $totalInterest = 0;

        for ($i = 1; $i <= $loanTermInMonths; $i++) {
            $interest = $balance * $monthlyInterestRate; // Monthly interest
            $dueDate = $creditStartDate->copy()->addMonths($i)->format('m/d/Y');
            $due = $principal + $interest;
            $principalBalance = $balance - $principal;
            $loanSchedule[] = [
                'due_date' => $dueDate,
                'principal' => $principal,
                'interest' => $interest,
                'due' => $due,
                'principal_balance' => $principalBalance,
            ];

            $balance = $principalBalance;
            $totalInterest += $interest;
        }


        // Insert loan schedule data into the database
        $creditPayments = [];
        foreach ($loanSchedule as $schedule) {
            $creditPayments[] = [
                'credit_id' => $credit->id,
                'paid_amount' => $schedule['due'],
                'interest' => $schedule['interest'],
                'principal_balance' => $schedule['principal_balance'],
                'principal' => $schedule['principal'],
                'paid_month' => Carbon::createFromFormat('m/d/Y', $schedule['due_date'])->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        CreditPayment::insert($creditPayments);

        return back()->with('message', 'The loan has been successfully given');
                    }

                }

                else if($request->witness_2){
                    $W1r2=Credit::query()
                    ->where('witness1',$request->witness_2)
                    ->where('credit_status',0)->count();

                    $W2r2=Credit::query()
                    ->where('witness2',$request->witness_2)
                    ->where('credit_status',0)->count();


                  if(($W1r2 + $W2r2) >= 2){
                      return back()->with('error',$request->witness_2 .' can not be witness for more than 2 members ');
                  }

                    $maxAllowedLoan=$MemberSavingAmount * 3;
                    $witnessTotalSavingAmount=$Witness2SavingAmount;
                    if($request->credit_amount > $maxAllowedLoan){

                        return back()->with('error','Member Allowed to Borrow Maximum  ' .$maxAllowedLoan. " Birr");
                    }

                    else if(($request->credit_amount) > ($witnessTotalSavingAmount + $MemberSavingAmount)){

                        return back()->with('error','Witness have not enough Amount of Money');
                    }

                    else{

                        $credit=new Credit();
                        $credit->member_id=$memberId;
                        $credit->credit_amount=$request->credit_amount;
                        $credit->interest_rate= $interestRate;
                        $credit->interest_amount=$totalInterest;
                        $credit->duration_in_month=$request->credit_duration;
                        $credit->total_payment=$loanAmount + array_sum(array_column($loanSchedule, 'interest'));
                        $credit->credit_start=$request->credit_start;
                        $credit->credit_end = Carbon::createFromFormat('m/d/Y', $dueDate)->format('Y-m-d');
                        $credit->witness1=$request->witness_2;
                        $credit->save();
                        $loanAmount = $request->credit_amount;
                        $loanTermInMonths = $request->credit_duration;
                        $principal = $loanAmount / $loanTermInMonths;
                        $creditStartDate = Carbon::parse($request->credit_start)->startOfDay();
                        $monthlyInterestRate = ($interestRate / 12) / 100;

                        // Prepare loan schedule data
                        $loanSchedule = [];
                        $balance = $loanAmount;
                        $totalInterest = 0;

                        for ($i = 1; $i <= $loanTermInMonths; $i++) {
                            $interest = $balance * $monthlyInterestRate; // Monthly interest
                            $dueDate = $creditStartDate->copy()->addMonths($i)->format('m/d/Y');
                            $due = $principal + $interest;
                            $principalBalance = $balance - $principal;
                            $loanSchedule[] = [
                                'due_date' => $dueDate,
                                'principal' => $principal,
                                'interest' => $interest,
                                'due' => $due,
                                'principal_balance' => $principalBalance,
                            ];

                            $balance = $principalBalance;
                            $totalInterest += $interest;
                        }


                        // Insert loan schedule data into the database
                        $creditPayments = [];
                        foreach ($loanSchedule as $schedule) {
                            $creditPayments[] = [
                                'credit_id' => $credit->id,
                                'paid_amount' => $schedule['due'],
                                'interest' => $schedule['interest'],
                                'principal_balance' => $schedule['principal_balance'],
                                'principal' => $schedule['principal'],
                                'paid_month' => Carbon::createFromFormat('m/d/Y', $schedule['due_date'])->format('Y-m-d'),
                                'created_at' => now(),
                                'updated_at' => now(),
                            ];
                        }

                        CreditPayment::insert($creditPayments);

                        return back()->with('message', 'The loan has been successfully given');

                        return back()->with('message','the loan is succesfully given');
                    }

                }

             }



        }

        public function UpdateCredit(Request $request,$id){

              //calculating the paid amount
           $credit=Credit::query()->where('id',$request->credit_id)->first();
           $totalPayment=$credit->total_payment;


           //dd($sumUnPaidAmount);

            $creditpayment=CreditPayment::query()->where('id',$id)->first();

            if($creditpayment->status == 0){

                CreditPayment::whereId($id)->update([
                    'status' => 1

                ]);
            $sumUnPaidAmount = CreditPayment::where('status', 0)->where('credit_id',$request->credit_id)->sum('paid_amount');
            if($sumUnPaidAmount==0){
                 Credit::whereId($request->credit_id)->update([
                    'credit_status'=>1
                 ]);
                 $FinishedCreditMessage="and Credit Repayment Finished";
            }
            else{
                $FinishedCreditMessage=$sumUnPaidAmount ."ETB remaining";
            }

                return back()->with("message","Credit saved $FinishedCreditMessage");
            }

        }

        public function viewCreditRequest(){
            $RequestCredits = RequestCredit::orderBy('created_at', 'asc')->get();
            return view('manager.ManageLoan.CreditRequest',compact('RequestCredits'));
        }

        public function missedPaymentList(){
            $missedPayment = CreditPayment::where('status', 0)
            ->where('paid_month', '<=', Carbon::now()->toDateString())
            ->get();


             return view("manager.ManageLoan.missedpayment",compact("missedPayment"));



        }

        public function ApproveRequest(Request $request,$id){
            $userId = $request->user_id;
            $user = User::find($userId);
            $creditDuration = $request->credit_duration;
            $creditAmount = $request->credit_amount;
            $requestCredit = RequestCredit::find($id);

            if ($requestCredit->status == 0) {
                RequestCredit::whereId($id)->update([
                    'status' => 1
                ]);

                if ($user) {
                    $user->notify(new CreditApproved($creditDuration, $creditAmount));
                    return back()->with("message", "Loan is approved");
                } else {
                    return back()->with("error", "User not found");
                }
            }

            return back()->with("message", "Loan approval failed");
        }

        public function viewCreditList(){

            $credits=Credit::query()->orderBy('created_at','desc')->get();


           return view('manager.ManageLoan.creditlist',compact('credits'));

        }

        public function viewcreditdetail($id){
            $credit=Credit::find($id);

            if($credit){
                $creditrepayments=CreditPayment::where('credit_id',$credit->id)->get();
                $paidamount=CreditPayment::where('credit_id',$credit->id)->where("status",1)->sum('paid_amount');


                return view('manager.ManageLoan.creditdetail',compact('credit','creditrepayments','paidamount'));
            }

            else{
                return view('error.404');
            }


        }

        public function witnesslist(){
            $witness=Credit::query()->orderBy('created_at','desc')->get();

            return view('manager.ManageLoan.WitnessList',compact('witness'));

        }

        public function creditPayment(){
            $members=Credit::query()->where('credit_status',0)->get();
            return view('manager.ManageLoan.CreditPayment',compact('members'));

        }
        public function addCreditPayment(Request $request){
            $this->validate($request,[
                'credit_id'=>'required|exists:credits,id',
                'paid_amount'=>'required|numeric|min:1',
                'paid_month'=>'required'
            ]);

             $creditID=$request->credit_id;
             $credit=Credit::query()->where('id',$creditID)->first();

             if($credit->credit_status == 1){
                return back()->with('error',"Credit Payment For Credit Id ".$creditID . " is Completed ");

             }

             $creditpayment=new CreditPayment;
             $creditpayment->credit_id=$creditID;
             $creditpayment->paid_amount=$request->paid_amount;
             $creditpayment->paid_month=$request->paid_month;
             $creditpayment->save();

              $totalPayment=$credit->total_payment;
              $paidamount=creditPayment::query()->where('credit_id',$creditID)->get();
               $TotalPaidCredit=$paidamount->sum('paid_amount');



              if($TotalPaidCredit >= $totalPayment){
                //when the member completly pay his loan the status is changed
                Credit::whereId($creditID)->update([
                    'credit_status'=>1
                ]);

                return back()->with('message','Credit Paid Succesfully and Member is Completly Paid His Credit');
              }

              return back()->with('message','Credit Paid Succesfully');


        }



    public function calculateLoanSchedule(Request $request)
    {
        $this->validate($request,[
           'Credit_amount'=>'required|numeric',
           'credit_duration'=>'required|integer',
        ]);
        if( $request->credit_duration <= 12){
            $interestRate =11.5;
         }

         if(($request->credit_duration) > 12 and ($request->credit_duration <= 36) ){
            $interestRate =11;
         }

         if($request->credit_duration >36 ){
            $interestRate =10.5;
         }

        $loanAmount = $request->Credit_amount;
        $loanTermInMonths = $request->credit_duration;
        $principal = $loanAmount / $loanTermInMonths;


        $monthlyInterestRate = ($interestRate / 12) / 100;

        $loanSchedule = [];

        $balance = $loanAmount;

        $totalInterest = 0;
        $interestCount = 0;
        for ($i = 1; $i <= $loanTermInMonths; $i++) {
            $interest = $balance * $monthlyInterestRate;
            $dueDate = Carbon::now()->addMonths($i)->format('m/d/Y');
            $description = 'Repayment';
            $due = $principal + $interest;
            $principalBalance = $balance - $principal;

            $loanSchedule[] = [
                'due_date' => $dueDate,
                'description' => $description,
                'principal' => $principal,
                'interest' => number_format($interest, 2),
                'due' => number_format($due, 2),
                'principal_balance' => number_format($principalBalance, 2),
            ];

            $balance = $principalBalance;
            $totalInterest += $interest;
            $interestCount++;


        }

        return view('manager.ManageLoan.loan-schedule', [
            'loanAmount' => $loanAmount,
            'loanTermInMonths' => $loanTermInMonths,
            'interestRate' => $interestRate,
            'principal' => $principal,
            'loanSchedule' => $loanSchedule,
        ]);
    }
}
