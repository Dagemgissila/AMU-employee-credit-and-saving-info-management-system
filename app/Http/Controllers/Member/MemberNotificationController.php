<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberNotificationController extends Controller
{
    public function viewNotification()
    {
        $user = User::find(auth()->user()->id);
        $notifications = $user->notifications()->get();

        $data = [];

        foreach ($notifications as $notification) {
            $data[] = $notification->data;
        }


        return view('members.notification',compact('data'));
    }
}
