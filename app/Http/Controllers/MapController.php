<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    //show map
    public function showMap(){
        return view('Map.map');
    }
}
