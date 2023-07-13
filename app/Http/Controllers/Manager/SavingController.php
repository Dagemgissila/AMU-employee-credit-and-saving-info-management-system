<?php

namespace App\Http\Controllers\Manager;

use Excel;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Member;
use App\Models\Saving;
use App\Models\SavingDetail;
use Illuminate\Http\Request;
use App\Models\SavingAccount;
use Illuminate\Validation\Rule;
use App\Imports\DepositmoneyImport;
use App\Http\Controllers\Controller;


class SavingController extends Controller
{
    public function savinglist()
    {
        if (auth()->user()->password_status == 0) {
            return redirect()->route('manager.changepassword');
        }

        $savingdetail = SavingAccount::query()
            ->with('member.user')
            ->orderBy('created_at', 'desc') // order by saving_month column in descending order
            ->get();

        return view('manager.ManageSaving.savinglist', compact('savingdetail'));
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
            return redirect()->route('manager.changepassword');
        }

        return view('manager.ManageSaving.createsaving');
    }

    public function CreateSaving(Request $request){

    }

    public function deposit(){
        if(auth()->user()->password_status == 0){
            return redirect()->route('manager.savingdetail');
        }
        //to display all members as drop down
         $members=Member::all();
        return view('manager.ManageSaving.deposit', compact('members'));

    }

    public function storemoney(Request $request){

        $validatedData = $request->validate([
            'zmember' => 'required',
            'saving_month' =>'required|date'
         ]);
        $user=User::where('username',$validatedData['zmember'])->first();

        //validate username

        if(!$user){
            return back()->with('error','the member is not found');
        }
        $member=Member::where('user_id',$user->id)->first();
         $member2=SavingAccount::where('member_id',$member->id)->first();
         //get registered date
         //dd($member2);
        $reg_date=$member->registered_date;

        //access previous month - recorded saving date
        if($member2!=null)
        {
            $previous_saving_date=$member2->saving_month;
            $prev_month_year=date('m-Y', strtotime($previous_saving_date));
            //dd($prev_month_year);
            $user_input_month=date('m-Y',strtotime($validatedData['saving_month']));
            //dd($user_input_month);
            if( $prev_month_year!= $user_input_month){
            if($validatedData['saving_month']<=Carbon::now()){
            if($validatedData['saving_month']>=$reg_date){
            //calculated saving monthly amount
            $monthly_saving_amount=$member->salary*($member->saving_percent/100);

            // Create a new SavingAccount record
            $savingAccount = new SavingAccount();
            $savingAccount->member_id = $member->id;
            //$savingAccount->saving_amount = $validatedData['saving_amount'];
            $savingAccount->saving_amount =$monthly_saving_amount;
            $savingAccount->saving_month = $validatedData['saving_month'];
            // Set the default saving percent here
            $savingAccount->save();


            // Access the related User object
            $fullname = $user->member->firstname . " ". $user->member->middlename;


            // Redirect back to the form with a success message
            return redirect()->back()->with('message', 'You  saved deposit successfully for '. $fullname);
            }
            else{
            //if user is trying to deposit for past month/year / le Tinant
            return redirect()->back()->with('error', 'Please select date equal to or after '.$reg_date);
            }
            }
            else{
            //if user tries to deposit for future month/year  / le Nege
            return redirect()->back()->with('error', 'Please select date equal to or before '.Carbon::now());
            }
            }
            else{
            //if deposit is already done for the selected month and year
            return redirect()->back()->with('error', 'Already deposited for this month '.$user_input_month);
            }
            }
    else{
           if($validatedData['saving_month']<=Carbon::now()){
            if($validatedData['saving_month']>=$reg_date){
            //calculated saving monthly amount
            $monthly_saving_amount=$member->salary*($member->saving_percent/100);

            // Create a new SavingAccount record
            $savingAccount = new SavingAccount();
            $savingAccount->member_id = $member->id;
            //$savingAccount->saving_amount = $validatedData['saving_amount'];
            $savingAccount->saving_amount =$monthly_saving_amount;
            $savingAccount->saving_month = $validatedData['saving_month'];
            // Set the default saving percent here
            $savingAccount->save();


            // Access the related User object
            $fullname = $user->member->firstname . " ". $user->member->middlename;


            // Redirect back to the form with a success message
            return redirect()->back()->with('message', 'You  saved deposit successfully for '. $fullname);
            }
            else{
            //if user is trying to deposit for past month/year / le Tinant
            return redirect()->back()->with('error', 'Please select date equal to or after '.$reg_date);
            }
            }
            else{
            //if user tries to deposit for future month/year  / le Nege
            return redirect()->back()->with('error', 'Please select date equal to or before '.Carbon::now());
            }
    }




            // Create a new SavingAccount record
           /* $user = User::where('id', $validatedData['zmember'])->first();
            $member = Member::where('user_id', $user->id)->first();*/



    }

      public function uploaddeposit(Request $request){
             $this->validate($request,[
                'upload_deposit'=>'required|mimes:xlsx,xls,csv'
             ]);


             Excel::import(new DepositmoneyImport,$request->file('upload_deposit'));
             return back();


      }

      public function deletesaving(Request $request){
        $saving=SavingAccount::find($request->saving_id);
        $saving->delete();

        return back()->with('message','successfully deleted');

      }

}
