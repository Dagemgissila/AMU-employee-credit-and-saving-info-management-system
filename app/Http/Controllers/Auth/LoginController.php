<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){

        try {
            $userCount = DB::table('users')->count();
            if ($userCount == 0) {
                    return redirect()->route('install');
            }

            return view('auth.login');

        } catch (\Illuminate\Database\QueryException $e) {
            // Handle the database connection exception
            if ($e->getCode() === 2002) { // Assuming the error code for database connection issue is 2002
                return response()->json(['message' => 'Unable to connect to the database. Please try again later.'], 500);
            } else {
                // Handle other database-related exceptions
                // You can customize the response based on different error codes or messages
                return response()->json(['message' => 'An error occurred while accessing the database.'], 500);
            }
        }

    }

    public function UserLogin(Request $request){
        $this->validate($request,[
            'username'=>'required|string|max:20',
            'password'=>'required|string|max:20'
        ]);



        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            if(auth()->user()->account_status == 0){
                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return back()->with('message','Your account is restricted');
            }
           if(auth()->user()->role == 'manager'){

               if(auth()->user()->password_status == 0){
                   return redirect()->route('manager.changepasswsord');
               }
               else{
                return redirect()->route('manager.dashboard');
               }
           }

           else if(auth()->user()->role == "admin"){
            return redirect()->route('admin.dashboard');
           }

           else if(auth()->user()->role == "member"){
            return redirect()->route('member.dashboard');
           }

           else if(auth()->user()->role == "credit_controller"){
            return redirect()->route('creditmanager.dashboard');
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

    public function back(){
         if(Auth::user()){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin.dashboard');
            }
            else if(Auth::user()->role == 'member'){
                return redirect()->route('member.dashboard');
            }
            else if(Auth::user()->role == 'manager'){
                return redirect()->route('manager.dashboard');
            }
         }

         return redirect()->route('login');
    }
}
