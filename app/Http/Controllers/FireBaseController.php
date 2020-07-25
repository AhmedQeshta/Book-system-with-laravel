<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;


use Illuminate\Http\Request;



class FireBaseController extends Controller
{
   public function puch(){
       
    $sourceKey = env('FIREBASE_FCM_KEY');
    $header = [
        "Content-type" => 'application/json',
        "Authorization" => 'Key='.$sourceKey
    ];
    $body =[
        "data" =>[
            "title" =>'FCM Title',
            "body" =>'FCM Body',
        ],
        "notification" =>[
            "title" =>'FCM Title',
            "body" =>'FCM Body',
        ],
        'to' => $sourceKey
    ];

// error in json packege i am don't use json_encode or json_dencode
        $client = new Client(['headers' => $header]);
        $response = $client->post('https://fcm.googleapis.com/fcm/send',[
            'body' => json_encode($body)
        ]);
        dd(json_dencode($response->getBody()));
   }
}
