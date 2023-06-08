<?php

namespace App\Http\Controllers\Manager;

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
            'saving_month' => [
                'required',
                Rule::unique('saving_accounts')->where(function ($query) use ($request) {
                    $user = User::where('username', $request->username)->first();
                    $member = Member::where('user_id', $user->id)->first();
                    $savingMonth = date('Y-m', strtotime($request->saving_month));
                    return $query->where('member_id', $member->id)
                                 ->whereRaw("DATE_FORMAT(saving_month, '%Y-%m') = ?", [$savingMonth]);
                }),
            ],

        ]
        , [
            'saving_month.unique' => ' For this member, you have already made a deposit for this month',
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
            $fullname = $user->member->firstname . " ". $user->member->lastname;


    // Redirect back to the form with a success message
    return redirect()->back()->with('message', 'you  deposit money successfully for '. $fullname);
    }
}
