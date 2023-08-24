<?php

namespace App\Http\Controllers\Member;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\SavingAccount;
use App\Http\Controllers\Controller;

class MemberDashboardController extends Controller
{
    public function index(){
        if(auth()->user()->password_status == 0){
            return view('members.changepassword');
        }
        //to bring saving balance total
        $user = auth()->user();
        $member = $user->member;
        $savingAccounts = $member->savingAccounts()->orderBy('saving_month')->get();
        $totalAmount=$savingAccounts->sum('saving_amount');

         $salary=Member::where('user_id',auth()->user()->id)->first();
         $shareBalance=$member->shares()->sum('share_amount');

         //to display saving percent on dashboard
         $savingPercent=Member::where('user_id',auth()->user()->id)->first();
        return view('members.dashboard',compact('salary','savingPercent','totalAmount','shareBalance'));
    }
}
