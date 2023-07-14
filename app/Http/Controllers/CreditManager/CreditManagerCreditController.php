<?php

namespace App\Http\Controllers\CreditManager;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\SavingAccount;
use App\Http\Controllers\Controller;

class CreditManagerCreditController extends Controller
{
    public function ViewMemberInfo()
    {
        if (auth()->user()->password_status == 0) {
            return redirect()->route('manager.changepassword');
        }

        $members = Member::query()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get the total saving amount for each member
        $total_savings = SavingAccount::query()
            ->selectRaw('member_id, SUM(saving_amount) as total_saving')
            ->groupBy('member_id')
            ->get()
            ->keyBy('member_id');

        return view('CreditManager.listofmembers', compact('members', 'total_savings'));
    }
}
