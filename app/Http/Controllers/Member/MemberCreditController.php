<?php

namespace App\Http\Controllers\Member;

use Carbon\Carbon;
use App\Models\Credit;
use Illuminate\Http\Request;
use App\Models\CreditPayment;
use App\Models\RequestCredit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MemberCreditController extends Controller
{
    public function index(){
        if(auth()->user()->password_status == 0){
            return view('members.changepassword');
        }
        $user=auth()->user();
        $member=$user->member;
        $credits=$member->credits()->orderBy('created_at','desc')->get();


        return view('members.mycredit',[
            'member'=>$member,
            'credits'=>$credits
        ]);
    }

    public function CreditDetail($id){
        $credit=Credit::find($id);

            if($credit){
                $creditrepayments=CreditPayment::where('credit_id',$credit->id)->get();
                $paidamount=CreditPayment::where('credit_id',$credit->id)->where("status",1)->sum('paid_amount');


                return view('members.MyCreditDetail',compact('credit','creditrepayments','paidamount'));
            }

            else{
                return view('error.404');
            }

    }

    public function ViewRequestPage(){
        if(auth()->user()->password_status == 0){
            return view('members.changepassword');
        }
        $user=Auth::user();
        $registeredDate = $user->member->registered_date;
        $currentDate=Carbon::now();
        $diffMonth=$currentDate->diffInMonths($registeredDate);

        $member = $user->member;
       $credits = $member->credits;

     // Check if there is any row with credit_status = 0
       $creditExist = $credits->contains('credit_status', 0);
       $requestExist=$member->requestCredits->contains('status',0);

        return view('members.RequestCredit', compact('diffMonth', 'creditExist','requestExist'));
    }
    public function RequestCredit(Request $request){
        $user = Auth::user(); // Retrieve the authenticated user
        $memberId = $user->member->id;
        $this->validate($request,[
            'credit_amount'=>'required|numeric',
            'credit_duration'=>'required|numeric'
        ]);

        $RequestCredit=new RequestCredit();
        $RequestCredit->member_id=$memberId;
        $RequestCredit->request_amount=$request->credit_amount;
        $RequestCredit->duration_in_month=$request->credit_duration;
        $RequestCredit->save();

        return back()->with("message", "Your loan request has been submitted successfully.
         We will review your request and get back to you shortly. Thank you for your patience.");


    }
}
