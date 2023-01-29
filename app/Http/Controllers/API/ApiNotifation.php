<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiNotifation extends Controller
{
    public function sendNotification($device_token,$title,$body)
    {
        $device_token = $device_token;
        $firebaseToken = User::where('device_token', $device_token)->whereNotNull('device_token')->pluck('device_token')->first();
        $SERVER_API_KEY = "AAAAYbWJUAw:APA91bGNiwh2qFPpsXtaEeEktVtqJsm0FFKSDBHZbGkZmFLSfDyiMAlQYgJ_Yh0ltcmF68z9bsDODql3Ye9zgaQFg2d7oR-je4D7YvyBrgMibTjeR2kX6y-jp22aPKpU4cck7KTpvtt8";
        $data = [
            "registration_ids" => [$firebaseToken],
            "notification" => [
                "title" => $title,
                "body" => $body,
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return back()->with('success', 'Notification send successfully.');
    }
}
