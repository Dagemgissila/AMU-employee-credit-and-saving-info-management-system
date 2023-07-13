<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Member;
use App\Models\SavingAccount;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class DepositmoneyImport implements ToCollection,WithHeadingRow,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
 public function collection(Collection $collection)
{
    $errors = []; // Initialize an array to store validation errors

    foreach ($collection as $row) {
        // Create a new SavingAccount record
        $user = User::where('username', $row['username'])->first();
        if (!$user) {
            $errors[] = 'Member not found for username: ' . $row['username'];
            continue; // Move to the next row
        }

      else{
        $member = Member::where('user_id', $user->id)->first();

        $previous_saving_date = SavingAccount::where('member_id', $member->id)
            ->orderBy('saving_month', 'desc')
            ->value('saving_month');

        if ($previous_saving_date && Carbon::parse($previous_saving_date)->format('Y-m') == Carbon::now()->format('Y-m')) {
            $errors[] = 'Member with username: ' . $row['username'] . ' has already made a deposit for this month.';
            continue; // Move to the next row
        }

        // Create a new SavingAccount record
        $savingAccount = new SavingAccount();
        $savingAccount->member_id = $member->id;
        // Calculate the saving monthly amount
        $monthly_saving_amount = $member->salary * ($member->saving_percent / 100);
        $savingAccount->saving_amount = $monthly_saving_amount;
        $savingAccount->saving_month = Carbon::now();
        // Set the default saving percent here
        $savingAccount->save();
      }
    }

    if (!empty($errors)) {
        return back()->withErrors($errors);
    }

    return redirect()->back()->with('message', 'Deposit money successfully');
}

    public function rules():array
    {

        return [
            'username'=>"required|exists:users,username",
        ];

    }
}
