<?php

namespace App\Http\Controllers\Manager;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreditController extends Controller
{
    public function index(){
        if(auth()->user()->password_status == 0){
            return redirect()->route('manager.changepassword');
        }
        return view('manager.ManageLoan.addcredit');
    }

    public function addcredit(Request $request){
         $this->validate($request,[
            'username'=>'required|exists:users,username',
            'credit_amount'=>'required',
            'credit_duration'=>'required',
            'interest_rate'=>'required|',
            'credit_start'=>'required',
            'witness_1'=>'required|exists:users,username',
            'witness_2'=>'required|exists:users,username'
         ]);

    }

    public function calculateLoanSchedule(Request $request)
    {
        $this->validate($request,[
           'Credit_amount'=>'required|numeric',
           'credit_duration'=>'required|numeric',
           'interest_rate'=>'required'
        ]);

        $loanAmount = $request->Credit_amount;
        $loanTermInMonths = $request->credit_duration;
        $interestRate = $request->interest_rate;
        $principal = $loanAmount / $loanTermInMonths;


        $monthlyInterestRate = ($interestRate / 12) / 100;

        $loanSchedule = [];

        $balance = $loanAmount;
        $totalInterest = 0;
        $interestCount = 0;
        for ($i = 1; $i <= $loanTermInMonths; $i++) {
            $interest = $balance * $monthlyInterestRate;
            $dueDate = Carbon::now()->addMonths($i)->format('m/d/Y');
            $description = 'Repayment';
            $due = $principal + $interest;
            $principalBalance = $balance - $principal;

            $loanSchedule[] = [
                'due_date' => $dueDate,
                'description' => $description,
                'principal' => $principal,
                'interest' => number_format($interest, 2),
                'due' => number_format($due, 2),
                'principal_balance' => number_format($principalBalance, 2),
            ];

            $balance = $principalBalance;
            $totalInterest += $interest;
            $interestCount++;

            // Calculate yearly average interest rate and monthly payment with interest rate
            // if ($i % 12 == 0) {
            //     $averageInterestRate = ($totalInterest / $loanAmount) * 100;
            //     $monthlyPaymentWithInterest = $principal + ($totalInterest / $interestCount);
            //     $year = $i / 12;

            //     echo "Year $year: Average Interest Rate - $averageInterestRate%, Monthly Payment With Interest Rate - $monthlyPaymentWithInterest<br>";

            //     $totalInterest = 0;
            //     $interestCount = 0;
            // }
        }

        return view('manager.ManageLoan.loan-schedule', [
            'loanAmount' => $loanAmount,
            'loanTermInMonths' => $loanTermInMonths,
            'interestRate' => $interestRate,
            'principal' => $principal,
            'loanSchedule' => $loanSchedule,
        ]);
    }
}
