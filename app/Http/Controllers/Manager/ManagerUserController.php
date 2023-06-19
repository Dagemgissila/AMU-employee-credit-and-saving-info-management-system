<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerUserController extends Controller
{
    public function createAccount(){
        if (auth()->user()->password_status == 0) {
            return redirect()->route('manager.changepassword');
        }

        return view('Manager.createaccount');
    }
}
