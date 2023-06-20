<?php

namespace App\Http\Controllers\Manager;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ManagerUserController extends Controller
{
    public function index(){
        if (auth()->user()->password_status == 0) {
            return redirect()->route('manager.changepassword');
        }

        return view('Manager.ManageAccount.createaccount');
    }

    public function createAccount(Request $request){
           $this->validate($request,[
               'username'=>'required|unique:users,username',
               'email'=>'required|unique:users,email',
               'role'=>'required'
           ]);

           $user=new User();
           $user->username=$request->username;
           $user->email=$request->email;
           $user->password=Hash::make(12345678);
           $user->role=$request->role;
           $user->save();

           return back()->with('message','account create succefully');

    }

     public function listOfAccount(){
            if(auth()->user()->password_status == 0){
                return redirect()->route('manager.changepassword');
            }
            $users=User::query()
            ->where('role','!=','admin')
            ->where('role','!=','manager')
            ->orderBy('created_at','desc')
            ->get();
         return view('Manager.ManageAccount.listOfAccount',compact('users'));
     }

     public function updateStatus(Request $request,$id) {
        $status = $request->input('status');
        $user = User::find($id);

        if($status==1){
            $user->account_status=0;
        }

        if($status==0){
            $user->account_status=1;
        }

        $user->save();
        return redirect()->back()->with('message','status update succesfully');
    }

    public function deleteaccount($id){
        $user=User::find($id);
    return response()->json(
        [
            'status'=>200,
            'user'=>$user
        ]
    );
    }

    public function destroy(Request $request)
    {
        $user=User::find($request->user_id);
        if($user->role !='member' ){
            $user->delete();
        }


        return redirect()->back()->with('message', 'user deleted successfully.');
    }

    public function resetpageview($id){
        $user=User::find($id);
        if(!$user){
          abort(404);
      }
      return view('Manager.ManageAccount.resetpassword',compact('user'));

  }

  public function resetpassword(Request $request,$id){
      $this->validate($request,[
          'password'=>'required|min:8',
          'confirm_password'=>'required|min:8|same:password'
      ]);

      $user=User::find($id);
     $user->password=Hash::make($request->password);
     $user->password_status=0;
     $user->save();

     return redirect()->route('manager.viewaccount')->with('message','password is reset succefully');
  }

}
