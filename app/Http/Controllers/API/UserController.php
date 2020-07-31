<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function update(Request $request , $id){
        // validator
        $validation =  Validator::make($request->all() , $this->rules($id));
        if ($validation->fails()){
            // use by controller.php
            return parent::error($validation->errors());
        }
        try {
            $user = User::findOrFail($id);
            $user->fill($request->all());
            $user->update() ;
            // use by controller.php
            return parent::success($user);
        }catch (ModelNotFoundException $modelNotFoundException){
            return parent::error('user NOt Found',404);
        }

    }

    private function rules($id = null){
        $rules = [
            'name'=>'required|min:3',
            'email'=>'required|min:3|unique:users,email'.($id != null ? ','.$id : ''),
            'password'=>'required|min:6',
        ];
        if ($id){
            unset($rules['password']);
        }
        return $rules;
    }
}
