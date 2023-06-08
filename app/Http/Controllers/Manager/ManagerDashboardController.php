<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerDashboardController extends Controller
{
    public function index(){
        if(auth()->user()->password_status == 0){
            return redirect()->route('manager.changepassword');
        }
        return view('manager.dashboard');
    }
}
