<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

//use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function store(Request $request){
        // validator
        $validation = $request->validate($this->rules());
//        $validation =  Validator::make($request->all() , $this->rules());
        if ($validation === false){
            return $validation->errors();
        }
        $request['password'] = Hash::make($request->input('password'));
//        dd($request->all());
        $user = new User();
        $user->fill($request->all());
        $user->save();
        return response()->json(['message' => 'user Save successfully'],200);
    }

    private function rules(){
        return [
            'name'=>'required|min:3',
            'email'=>'required|min:3|unique:users,email',
            'password'=>'required|min:6',
        ];
    }
}
