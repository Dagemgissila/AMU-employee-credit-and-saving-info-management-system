<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $totaluser=User::all();
        $manager=User::query()->where('role','manager')->get();
        $member=User::query()->where('role','member')->get();
        $admin=User::query()->where('role','admin')->get();
        $blockuser=User::query()
        ->where('account_status','==',0)
        ->where('role','!=','admin')
        ->get();
        return view('admin.dashboard',compact('totaluser','manager','member','admin','blockuser'));
    }
}
