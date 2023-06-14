<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberCreditController extends Controller
{
    public function index(){
        if(auth()->user()->password_status == 0){
            return view('members.changepassword');
        }
        $user=auth()->user();
        $member=$user->member;
        $credits=$member->credits()->orderBy('created_at')->get();


        return view('members.mycredit',[
            'member'=>$member,
            'credits'=>$credits
        ]);
    }
}
