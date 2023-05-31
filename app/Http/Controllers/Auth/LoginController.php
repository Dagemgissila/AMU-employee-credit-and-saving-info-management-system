<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        $userCount = DB::table('users')->count();

        if ($userCount == 0) {
                return redirect()->route('install');
        }
        return view('auth.login');
    }

    public function UserLogin(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
           if(auth()->user()->role == 'manager'){

              return redirect()->route('manager.dashboard');
           }

           else if(auth()->user()->role == "admin"){
            return redirect()->route('admin.dashboard');
           }

           else if(auth()->user()->role == "member"){
            return redirect()->route('members.home');
           }
        }

        else{
            return redirect()->back()->with('message','invalid login detail');
        }

    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
