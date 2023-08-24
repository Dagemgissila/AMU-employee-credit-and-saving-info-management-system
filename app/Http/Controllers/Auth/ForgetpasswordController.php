<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetpasswordController extends Controller
{
    public function index(){
        return view('auth.password.passwordreset');
    }

    public function forgetPasswordPost(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users'
        ]);

        $token=Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);
         Mail::send('emails.forget-password',['token'=>$token],function($message) use ($request){
            $message->to($request->email);
            $message->subject("Reset Password");
         });

         return redirect()->route('forget-password')->with('success',"the link is send to your email address");

    }

    public function resetpassword($token){
      return view('auth.password.newpassword',compact('token'));
    }

    public function newpassword(Request $request){
        $this->validate($request,[
            'email'=>'required|email|exists:users',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'confirm_password' => 'required|min:8|same:password',
        ]);



        $updatepassword=DB::table('password_reset_tokens')
        ->where([
            'email'=>$request->email,
            'token'=>$request->token
        ])->first();

        if(!$updatepassword){
            dd("error");
        }

        User::where('email',$request->email)
        ->update([
            'password'=>Hash::make($request->passwoord)
        ]);

        DB::table('password_reset_tokens')->where('email',$request->email)->delete();

        return redirect()->route('login')->with('success','password reset succesfully');
    }
}
