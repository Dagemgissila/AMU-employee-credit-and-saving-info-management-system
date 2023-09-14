<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Share;
use App\Models\Member;
use App\Models\SavingAccount;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MembersImport implements ToCollection,WithHeadingRow,WithValidation
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {


            DB::beginTransaction();

            try {
                $username = ucfirst(strtolower($row['firstname'])) . '/' . substr($row['phonenumber'], -4);
                $baseUsername = $username;
                $suffix = 1;

                // Check if the base username already exists in the database
                while (User::where('username', $username)->exists()) {
                    // If it does, append a unique suffix to the username and try again
                    $suffix++;
                    $username = $baseUsername . "/" . $suffix;
                }

                // insert a new user
                $user = new User();
                $user->username = $username;
                $user->email=$row['email'];
                $user->password = Hash::make(12345678);
                $user->role = 'member';
                $user->save();

                // insert a new member
                $member = new Member;
                $member->firstname = ucfirst(strtolower($row['firstname']));
                $member->middlename = ucfirst(strtolower($row['middlename']));
                $member->lastname = ucfirst(strtolower($row['lastname']));
                $member->saving_percent = $row['savingpercent'];
                $member->bank_account = $row['bankaccount'];
                $member->phone_number = $row['phonenumber'];
                $member->salary = $row['salary'];
                $member->campus = ucfirst(strtolower($row['campus']));

                $member->sex = ucfirst(strtolower($row['sex']));
                $member->martial_status = ucfirst(strtolower($row['martialstatus']));



                $member->registered_date = Carbon::now();

                $member->user_id = $user->id; // set the user_id foreign key
                $member->save();

                //
                // $saving = new SavingAccount;
                // $saving->member_id = $member->id;
                // $saving->saving_amount = 0;
                // $saving->saving_month=Carbon::now();
                // $saving->status=0;
                // $saving->save();

                $share=new Share;
                $share->member_id=$member->id;
                $share->share_amount=100;
                $share->save();

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }

        return redirect()->back()->with('message', 'Members registered successfully');
    }

    public function rules():array
    {

        return [
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'lastname' => 'required|string',
            'bankaccount'=>'required|numeric|unique:members,bank_account',
            'phonenumber'=>'required|numeric|unique:members,phone_number',
            'savingpercent'=>'required|numeric|min:10|max:30',
            'salary'=>'required|numeric',
            'campus'=>'required|string',
            'email'=>'required|unique:users',
            'sex'=>'required|string',
            'martialstatus'=>'required|string',


        ];
    }
}
