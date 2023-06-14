<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberProfileController extends Controller
{
    public function index()
    {

        if (auth()->user()->password_status == 0) {
            return view('members.changepassword');
        }
        $user = auth()->user();
        $member = $user->member;

        return view('members.profile', compact('member'));
    }}
