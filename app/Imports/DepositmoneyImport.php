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
    public function collection(Collection $collection){
        foreach($collection as $row){

                // Create a new SavingAccount record
                $user = User::where('username', $row['username'])->first();
                $member = Member::where('user_id', $user->id)->first();


                // Create a new SavingAccount record
                $savingAccount = new SavingAccount();
                $savingAccount->member_id = $member->id;
                $savingAccount->saving_amount = $row['savingamount'];
                $savingAccount->saving_month = Carbon::now();
                 // Set the default saving percent here
                $savingAccount->save();

        }

        return redirect()->back()->with('message', 'deposit money successfully');
    }

    public function rules():array
    {

        return [
            'username'=>"required|exists:users,username",

            'savingamount'=>'required|numeric|min:0',

        ];

    }
}
