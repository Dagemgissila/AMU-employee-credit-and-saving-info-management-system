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
         $salary=Member::where('user_id',auth()->user()->id)->first();
        $savingbalance=SavingAccount::query()->where('member_id','==',auth()->user()->member->id)->sum('saving_amount');

        return view('members.dashboard',compact('savingbalance','salary'));
    }
}
