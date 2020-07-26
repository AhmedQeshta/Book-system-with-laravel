<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Map;

class MapController extends Controller
{
    //show map
    public function showMap(){
        return view('Map.map');
    }

    public function store(Request $request){
        // Validation
        $request->validate($this->rules());

      // save data in DB

        Map::create($request->all());
        

    return redirect(route('map'))->with('success',__('map.messages.createdSuccessfully'));

    }

    // method to help 
    private function rules(){
        $rules = [
            'lat'  => 'min:1|max:20',
            'lng'  => 'min:1|max:20',
        ];

        return $rules;
    }
}
