<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
class SavingAccountController extends Controller
{
    public function index(){
        if(auth()->user()->password_status == 0){
            return view('members.changepassword');
        }

        $user = auth()->user();
        $member = $user->member;
        $savingAccounts = $member->savingAccounts()->orderBy('saving_month')->get();
        $totalAmount=$savingAccounts->sum('saving_amount');

        return view('members.savingaccount', [
            'member' => $member,
            'savingAccounts' => $savingAccounts,
            'totalAmount'=>$totalAmount
        ]);


    }
}
