<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InstallController extends Controller
{
    public function index(){
        $userCount = User::count();

        if ($userCount > 0) {
            abort(404);
        }
          return view('auth.adminRegister');
    }

    public function create(Request $request){
        $this->validate($request, [
            'username' => 'required|min:4|unique:users',
            'email' => 'required|email|unique:users',
            //tha password must be min 8 char,at least 1 upper case, 1 lower case ,1 number, 1 special char
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'confirm_password' => 'required|min:8|same:password',
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->account_status=1;
        $user->password_status=1;
        $user->save();


        return redirect('/login')->with('success','you register succesfully');
    }
}
