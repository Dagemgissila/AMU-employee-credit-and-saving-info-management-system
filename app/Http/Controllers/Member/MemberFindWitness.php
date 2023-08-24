<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MemberFindWitness extends Controller
{
    public function index(Request $request){

             $user=auth()->user();
        $userSavingAmount=$user->member->savingAccounts->sum('saving_amount');
        $creditAmount=$request->credit_amount;
        $creditDuration=$request->credit_duration;
        //condition for select witness for loan
         $witnessBalanceRequred=$creditAmount-$userSavingAmount;
         $member=Member::all();

           foreach($member as $x){
            $witnessSavingAmount[]=$x->savingAccounts->sum('saving_amount');
            $witnessLis[]=$witnessSavingAmount > $witnessBalanceRequred;
           }





        return view('members.FindWitness',compact('creditAmount','creditDuration'));



    }
}
