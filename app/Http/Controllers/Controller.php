<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\MessageBag;
use Ramsey\Collection\Collection;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest:admin');
    }


    public function uploadImage($image , $dir = 'image')
    {
        $uploadImage = $image;
        $imagename = time(). '.' . $uploadImage->getClientOriginalExtension();
        $direction = public_path('/'.$dir.'/');
        $uploadImage->move($direction,$imagename);
        $imagePath = $dir. '/' . $imagename ;
        return $imagePath;
    }

//    to use in api response
    public static function success($message,$status = 200){
        return response()->json(['status' => 'success' , 'errors' => 0 , 'data'=>$message ],$status)
            ->header('Content-Type','application/json');
    }

    public static function error($message,$status = 400){
        $messageCount = 1 ;
        if (is_array($message)){
            $messageCount = sizeof($messageCount);
        }elseif($message instanceof Collection){
            $messageCount = $message->count();
        }
        if ($message instanceof MessageBag){
            $message = $message->first();
        }
        return response()->json(['status' => 'error', 'errors'=>$messageCount, 'data'=>$message ],$status)
            ->header('Content-Type','application/json');
    }


}
