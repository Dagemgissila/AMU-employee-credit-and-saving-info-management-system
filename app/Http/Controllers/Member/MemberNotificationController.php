<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class MemberNotificationController extends Controller
{
    public function viewNotification()
    {
        $user = User::find(auth()->user()->id);
        $notifications = $user->notifications()->get();

        $data = [];

        foreach ($notifications as $notification) {
            $data[] = [
                'read_at'=>$notification->read_at,
                'id' => $notification->id,
                 'Greeting'=>$notification->data['Greeting'],
                'Subject' => $notification->data['Subject'],
                'Message' => $notification->data['Message'],

                // Add more columns as needed
            ];


            $notification = \Illuminate\Notifications\DatabaseNotification::find($notification->id,);

            if ($notification) {
                $notification->update(['read_at' => now()]);

            }
        }

        return view('members.notification', compact('data'));
    }

    public function read(Request $request)
    {
        $notificationId = $request->notification_id;

        $notification = \Illuminate\Notifications\DatabaseNotification::find($notificationId);

        if ($notification) {
            $notification->update(['read_at' => now()]);

            return back();
        }
    }
}
