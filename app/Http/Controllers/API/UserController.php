<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{

    public function store(Request $request){
        // validator
        $validation =  Validator::make($request->all() , $this->rules());
        if ($validation->fails()){
             // use by controller.php
            return parent::error($validation->errors());
        }
        $request['password'] = Hash::make($request->input('password'));
        $user = new User();
        $user->fill($request->all());
        $user = User::create($request->all()) ;
            // use by controller.php
        return parent::success($user);
    }

    private function rules(){
        return [
            'name'=>'required|min:3',
            'email'=>'required|min:3|unique:users,email',
            'password'=>'required|min:6',
        ];
    }
}
