<?php

namespace App\Http\Controllers\Manager;

use Excel;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Share;
use App\Models\Member;
use App\Models\Saving;
use Illuminate\Http\Request;
use App\Models\SavingAccount;
use App\Imports\MembersImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class MemberController extends Controller
{
    public function index(){
        if(auth()->user()->password_status == 0){
            return redirect()->route('manager.changepassword');
        }
        return view('manager.ManageMember.addmembers');
    }
    public function UploadMemberExcel(Request $request) {
        $this->validate($request,[
            'member_excel_data'=>'required|mimes:xlsx,xls,.csv'
        ]);
      Excel::import(new MembersImport,$request->file('member_excel_data'));
      return back();

    }

    public function addmember(Request $request){
        $this->validate($request,[
            'firstname'=>'required|string',
            'middlename'=>'required|string',
            'lastname'=>'required|string',
            'bankaccount'=>'required|numeric|unique:members,bank_account',
            'phonenumber'=>'required|numeric|unique:members,phone_number',
            'savingpercent'=>'required|numeric|min:10|max:30',
            'salary'=>'required|numeric',
            'campus'=>'required|string',
             'email'=>'required|unique:users',
            'sex'=>'required|string',
            'martial_status'=>'required|string',

                 ],[

                    'bank_account'=>'the bank account number already exists',
                    'phone_number'=>'the phone number already exists',
                    'savingpercent.max'=>'maximum value must be 30',
                    'savingpercent.min'=>'minimum value must be 10'
                 ]);
                 DB::beginTransaction();

                 try {
                    $username = ucfirst(strtolower($request->firstname)) . '/' . substr($request->phonenumber, -4);
                    $baseUsername = $username;
                    $suffix = 1;

                    // Check if the base username already exists in the database
                    while (User::where('username', $username)->exists()) {
                    // If it does, append a unique suffix to the username and try again
                    $suffix++;
                    $username = $baseUsername ."/". $suffix;
                     }

                     // insert a new user
                     $user = new User();
                     $user->username = $username;
                     $user->email=$request->email;
                     $user->password = Hash::make(12345678);
                     $user->role = 'member';
                     $user->save();

                     // insert a new member
                     $member = new Member;
                     $member->firstname = ucfirst(strtolower($request->firstname));
                     $member->middlename = ucfirst(strtolower($request->middlename));
                     $member->lastname = ucfirst(strtolower($request->lastname));
                     $member->saving_percent = $request->savingpercent;
                     $member->bank_account = $request->bankaccount;
                     $member->phone_number = $request->phonenumber;
                     $member->salary = $request->salary;
                     $member->campus = $request->campus;
                     $member->sex =ucfirst(strtolower($request->sex));
                     $member->colleage = ucfirst(strtolower($request->colleage));
                     $member->martial_status = ucfirst(strtolower($request->martial_status));
                     $member->registered_date = Carbon::now();
                     $member->user_id = $user->id; // set the user_id foreign key
                     $member->save();



                    $share=new Share;
                     $share->member_id=$member->id;
                     $share->share_amount=100;
                     $share->save();

                     DB::commit();

                     return redirect()->back()->with('message', 'Member registered successfully');

                 } catch (\Exception $e) {
                     DB::rollback();

                       return redirect()->back()->with('error', $e->getMessage());
                 }


    }

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

        return view('manager.ManageMember.listofmembers', compact('members', 'total_savings'));
    }


    public function show($id){
        if(auth()->user()->password_status == 0){
            return redirect()->route('manager.changepassword');
        }
        $member=Member::find($id);
        if(!$member){
            return view("error.404");
        }
        else{
            return view('manager.ManageMember.edit',compact('member'));
        }

    }

    public function editmember(Request $request,$id){
        $member=Member::find($id);
        $this->validate($request, [
            'firstname' => 'required|string',
            'middlename' => 'required|string',
            'lastname' => 'required|string',
            'bankaccount' => 'required|numeric|unique:members,bank_account,' . $member->id,
            'phonenumber' => 'required|numeric|unique:members,phone_number,' . $member->id,
            'salary' => 'required|numeric',
            'SavingPercent'=>'required|numeric|min:10|max:30',
            'campus' => 'required|string',
            'email'=>'required|unique:users,email,'.$member->user->id,
            'sex' => 'required|string',
            'martial_status' => 'required|string',
            'registered_date' => 'required',
        ], [
            'username.unique' => 'The username is already in use.',
        ]);



                 $member->firstname = ucfirst(strtolower($request->firstname));
                 $member->middlename = ucfirst(strtolower($request->middlename));
                 $member->lastname = ucfirst(strtolower($request->lastname));
                 $member->bank_account=$request->bankaccount;
                 $member->phone_number=$request->phonenumber;
                 $member->salary=$request->salary;
                 $member->saving_percent=$request->SavingPercent;
                 $member->campus=$request->campus;
                 $member->sex=ucfirst(strtolower($request->sex));
                 $member->colleage = ucfirst(strtolower($request->colleage));
                 $member->martial_status = ucfirst(strtolower($request->martial_status));
                 $member->registered_date=$request->registered_date;

                // Update the related User model's username value
                $baseUsername = ucfirst(strtolower($request->firstname)). '/' . substr($request->phonenumber, -4);
                $suffix = 1;
                $username = $baseUsername;

                // Check if the base username already exists in the database
                while (User::where('username', $username)->where('id', '!=', $member->user->id)->exists()) {
                    // If it does, append a unique suffix to the username and try again
                    $suffix++;
                    $username = $baseUsername ."/". $suffix;
                }

                // If the final username is unique, update the related User model's username value
                if ($username !== $member->user->username) {
                    $member->user->username = $username;
                    $member->user->save();
                }
                User::whereId($member->user->id)->update([
                    'email'=>$request->email
                ]);
                 $member->save();
                return redirect()->route('manager.viewmember')->with('message','member update  succesfully');
    }

    public function ViewMember($id)
    {
        $member = Member::findOrFail($id);
        $savingAmount=SavingAccount::query()->where('member_id',$id)->sum('saving_amount');
        $shareAmount=Share::query()->where('member_id',$id)->sum('share_amount');
        $response = [
            'share'=>$shareAmount,
            'member' => $member,
            'saving' => $savingAmount,
        ];

        return response()->json($response);
    }




}
