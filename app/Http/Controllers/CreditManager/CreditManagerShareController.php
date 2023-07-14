<?php

namespace App\Http\Controllers\CreditManager;

use App\Models\Share;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreditManagerShareController extends Controller
{
    public function index(){
        if(auth()->user()->password_status == 0){
            return redirect()->route('manager.changepassword');
        }
        $shares=Share::all();

        return view('CreditManager.viewshare',compact('shares'));
    }
}
