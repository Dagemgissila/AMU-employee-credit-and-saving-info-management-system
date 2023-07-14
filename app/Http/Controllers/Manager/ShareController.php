<?php

namespace App\Http\Controllers\Manager;

use App\Models\User;
use App\Models\Share;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShareController extends Controller
{
    public function index(){
        if(auth()->user()->password_status == 0){
            return redirect()->route('manager.changepassword');
        }
        $shares=Share::query()->orderBy('created_at','desc')->get();

        return view('manager.ManageShare.viewshare',compact('shares'));
    }

    public function shareform(){
        if(auth()->user()->password_status == 0){
            return redirect()->route('manager.changepassword');
        }
        $members=Member::all();
        return view('manager.ManageShare.sellshare',compact('members'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'member'=>'required',
            'share_amount'=>'required',

        ]);

        $user=User::where('username',$request->member)->first();

        if(!$user){
            return back()->with('error','Member Is not Found');
        }

        $member=Member::where('user_id',$user->id)->first();
        $membershare=Share::where('member_id',$member->id)->first();


        $share=new Share();
        $share->member_id=$member->id;
        $share->share_amount=$request->share_amount;
        $share->save();

         // Access the related User object
         $fullname = $user->member->firstname . " ". $user->member->middlename;

        return back()->with('message','you sell share successfully for '.$fullname);



    }
}
