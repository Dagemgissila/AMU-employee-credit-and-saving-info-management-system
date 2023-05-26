<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            'username' => 'required|min:4',
            'email' => 'required|email',
            //tha password must be min 8 char,at least 1 upper case, 1 lower case ,1 number, 1 special char
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'confirm_password' => 'required|min:8|same:password',
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->account_status=1;
        $user->save();


        return redirect('/login')->with('message','you register succesfully');
    }
}
