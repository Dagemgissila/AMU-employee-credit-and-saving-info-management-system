<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminUserConroller extends Controller
{
    public function index(){
        return view('admin.create');
    }

    public function create(Request $request){
        $this->validate($request,[
            'username'=>'required|min:4|unique:users',
            'email'=>'email|unique:users',
            'role'=>'required'
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt(12345678);
        $user->role=$request->role;
        $user->save();
    return redirect()->back()->with('message','account create succesfully');

    }

    public function listofuser(){
        $users=User::query()
        ->where('role','=','manager')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.listofuser',compact('users'));
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

    public function resetpageview($id){
          $user=User::find($id);
          if(!$user){
            abort(404);
        }
        return view('admin.resetpassword',compact('user'));

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

       return redirect()->route('admin.listofuser')->with('message','password is reset succefully');
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
    $user->delete();

    return redirect()->route('admin.listofuser')->with('message', 'user deleted successfully.');
}

public function edit($id){
    $user=User::find($id);
    return response()->json(
        [
            'status'=>200,
            'user'=>$user
        ]
    );

}

public function updateaccount(Request $request){
    $this->validate($request, [
        'username' => 'required|min:4|unique:users,username,'.$request->user_id,
        'email' => 'email|unique:users,email,'.$request->user_id,
    ]);

    $user=User::find($request->user_id);
    $user->username=$request->username;
    $user->email=$request->email;
    $user->update();

    return redirect()->route('admin.listofuser')->with('message', 'user account updated successfully.');

}
}
