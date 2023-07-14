<?php

namespace App\Http\Controllers\CreditManager;

use App\Models\Credit;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\SavingAccount;
use App\Http\Controllers\Controller;

class CreditManagerDashboardController extends Controller
{
    public function index(){
        if(auth()->user()->password_status == 0){
            return redirect()->route('creditmanager.changepassword');
        }
        $totalmember=Member::all();
        $totalcredit=Credit::all();
        $totalSavingAmount=SavingAccount::sum('saving_amount');
        $paidCredit=Credit::query()->where('credit_status',1)->get();
        $unpaidCredit=Credit::query()->where('credit_status',0)->get();
        $totalAmountCredit=Credit::sum('credit_amount');
        $totalPaidCredit=Credit::query()->where('credit_status',1)->sum('credit_amount');
        $totalUnPaidCredit=Credit::query()->where('credit_status',0)->sum('credit_amount');
        return view('CreditManager.dashboard',
        compact('totalmember','totalcredit','totalSavingAmount'
        ,'paidCredit','unpaidCredit','totalAmountCredit','totalPaidCredit','totalUnPaidCredit'));
    }
}
