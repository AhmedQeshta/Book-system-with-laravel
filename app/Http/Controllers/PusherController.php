<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;
use App\Admin;
class PusherController extends Controller
{
    public function push(){
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
          );
          $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
          );
        
          $admin = Admin::first();
          $data['message'] = 'hello world';
          $data['admin'] = $admin;
          $pusher->trigger('library', 'all', $data); //push notification for all library
        //   $pusher->trigger('library', 'library_id', $data); //push notification for specific library
    }
}
