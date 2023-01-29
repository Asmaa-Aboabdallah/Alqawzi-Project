<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function send(Request $request)
    // {
    //     $SERVER_API_KEY = 'AAAAYbWJUAw:APA91bGNiwh2qFPpsXtaEeEktVtqJsm0FFKSDBHZbGkZmFLSfDyiMAlQYgJ_Yh0ltcmF68z9bsDODql3Ye9zgaQFg2d7oR-je4D7YvyBrgMibTjeR2kX6y-jp22aPKpU4cck7KTpvtt8';

    //     $firebaseToken = User::whereNotNull('access_token')->pluck('access_token')->all();


    //     $data = [
    //         "registration_ids" => $firebaseToken,
    //         "notification" => [
    //             "title" =>"hfdhdf",
    //             "body" => "fhffdhf",
    //             "content_available" => true,
    //             "priority" => "high",
    //         ]
    //     ];
    //     $dataString = json_encode($data);

    //     $headers = [
    //         'Authorization: key=' . $SERVER_API_KEY,
    //         'Content-Type: application/json',
    //     ];

    //     $ch = curl_init();

    //     curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    //     $response = curl_exec($ch);

    //     dd($response);
    // }
}

// // Import the functions you need from the SDKs you need
// import { initializeApp } from "firebase/app";
// import { getAnalytics } from "firebase/analytics";
// // TODO: Add SDKs for Firebase products that you want to use
// // https://firebase.google.com/docs/web/setup#available-libraries

// // Your web app's Firebase configuration
// // For Firebase JS SDK v7.20.0 and later, measurementId is optional
// const firebaseConfig = {
//   apiKey: "AIzaSyB6c5oVxwdsyD8p0Dl2G5H8fhhQNBdeXio",
//   authDomain: "al-qawziproject.firebaseapp.com",
//   projectId: "al-qawziproject",
//   storageBucket: "al-qawziproject.appspot.com",
//   messagingSenderId: "419657502732",
//   appId: "1:419657502732:web:9f5a0fb2f6d500ec269e29",
//   measurementId: "G-NZRBE11RPL"
// };

// // Initialize Firebase
// const app = initializeApp(firebaseConfig);
// const analytics = getAnalytics(app);
