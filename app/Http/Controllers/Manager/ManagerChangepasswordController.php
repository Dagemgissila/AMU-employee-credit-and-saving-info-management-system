<?php

namespace App\Http\Controllers\Manager;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ManagerChangepasswordController extends Controller
{
    public function index(){
        return view('manager.changepassword');
    }

    public function changepassword(Request $request){
        $this->validate($request,[
            'oldpassword'=>'required',
            'newpassword' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'confirm_password' => 'required|min:8|same:newpassword',
        ]);

        if(!Hash::check($request->oldpassword, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }

             #Update the new Password
             User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->newpassword),
                'password_status'=>1
            ]);

             return redirect()->route('manager.dashboard')->with('message','Password change succesfully');

    }
}
