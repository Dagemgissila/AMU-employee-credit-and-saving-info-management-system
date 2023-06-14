<?php

namespace App\Http\Controllers\Manager;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Member;
use App\Models\Saving;
use App\Models\SavingDetail;
use Illuminate\Http\Request;
use App\Models\SavingAccount;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class SavingController extends Controller
{
    public function savinglist(){
        if(auth()->user()->password_status == 0){
            return redirect()->route('manager.changepassword');
        }
       $savingdetail = SavingAccount::query()
    ->with('member.user')
    ->orderByDesc('id')
    ->get();




        return view('manager.ManageSaving.savinglist',compact('savingdetail'));


    }

    public function viewdetail($id){
        if(auth()->user()->password_status == 0){
            return redirect()->route('manager.savingdetail');
        }

        $savingdetail = SavingAccount::query()
        ->where('user_id', $id)
        ->get();




        return view('manager.ManageSaving.savingdetail',compact('savingdetail'));
    }

    public function CreateSavingForm(){
        if(auth()->user()->password_status == 0){
            return redirect()->route('manager.savingdetail');
        }

        return view('manager.ManageSaving.createsaving');
    }

    public function CreateSaving(Request $request){

    }

    public function deposit(){
        if(auth()->user()->password_status == 0){
            return redirect()->route('manager.savingdetail');
        }

        return view('manager.ManageSaving.deposit');

    }

    public function storemoney(Request $request){

        $validatedData = $request->validate([
            'username' => 'required|exists:users,username',
            'saving_amount' => 'required|numeric|min:0',
            'saving_month' =>"required|date"
         ]);
        $user=User::where('username',$validatedData['username'])->first();

        $member=Member::where('user_id',$user->id)->first();



            // Create a new SavingAccount record
            $user = User::where('username', $validatedData['username'])->first();
            $member = Member::where('user_id', $user->id)->first();


            // Create a new SavingAccount record
            $savingAccount = new SavingAccount();
            $savingAccount->member_id = $member->id;
            $savingAccount->saving_amount = $validatedData['saving_amount'];
            $savingAccount->saving_month = $validatedData['saving_month'];
             // Set the default saving percent here
            $savingAccount->save();



            // Access the related User object
            $fullname = $user->member->firstname . " ". $user->member->middlename;


    // Redirect back to the form with a success message
    return redirect()->back()->with('message', 'you  deposit money successfully for '. $fullname);
    }

    public function calculateLoanSchedule(Request $request)
    {
        $loanAmount = 90000;
        $loanTermInMonths = 60;
        $interestRate = 10.5; // 10.5% per year
        $principal = $loanAmount / $loanTermInMonths;//1500

        $monthlyInterestRate = ($interestRate / 12) / 100; //0.000

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

            // Calculate yearly average interest rate and monthly payment with interest rate
            if ($i % 12 == 0) {
                $averageInterestRate = ($totalInterest / $loanAmount) * 100;
                $monthlyPaymentWithInterest = $principal + ($totalInterest / $interestCount);
                $year = $i / 12;

                echo "Year $year: Average Interest Rate - $averageInterestRate%, Monthly Payment With Interest Rate - $monthlyPaymentWithInterest<br>";

                $totalInterest = 0;
                $interestCount = 0;
            }
        }

        return view('loan-schedule', [
            'loanAmount' => $loanAmount,
            'loanTermInMonths' => $loanTermInMonths,
            'interestRate' => $interestRate,
            'principal' => $principal,
            'loanSchedule' => $loanSchedule,
        ]);
    }

}
