<?php

namespace App\Http\Controllers\Member;

use App\Models\Share;
use Jenssegers\Date\Date;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SavingAccountController extends Controller
{
    public function index(){
        if(auth()->user()->password_status == 0){
            return view('members.changepassword');
        }

        $user = auth()->user();
        $member = $user->member;
        $savingAccounts = $member->savingAccounts()->orderBy('saving_month','desc')->get();
        $totalAmount=$savingAccounts->sum('saving_amount');

        return view('members.savingaccount', [
            'member' => $member,
            'savingAccounts' => $savingAccounts,
            'totalAmount'=>$totalAmount
        ]);


    }
    public function share(){
      if(auth()->user()->password_status == 0){
          return view('members.changepassword');
      }

      $user = auth()->user();
      $member = $user->member;

      $share=Share::query()->where('member_id',$member->id)->orderBy('created_at','desc')->get();
      $shareAmount=$user->member->shares->sum('share_amount');

      return view('members.share',[
        'member'=>$member,
        'shareAmount'=>$shareAmount,
        'share'=>$share
      ]);
    }
}
