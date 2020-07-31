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

    public function index(){
        try {
            $users = User::all();
            return parent::success($users);
        }catch (ModelNotFoundException $modelNotFoundException){
            return parent::error('Error' , 404);
        }

    }

    public function show($id){
        try {
            $users = User::findOrFail($id);
            return parent::success($users);
        }catch (ModelNotFoundException $modelNotFoundException){
            return parent::error('this user not found',404);
        }

    }

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

    public function destroy($id){
        try {
            $user = User::findOrFail($id);
            $result = $user->delete();
            if ($result === true)
                return parent::success('This user, Deleted successfully');
            return self::error('something went wrong');
        }catch (ModelNotFoundException $modelNotFoundException){
            return parent::error('this user not found',404);
        }

    }

    private function rules($id = null){
        $rules = [
            'name'=>'required|min:3',
            'email'=>'required|min:3|unique:users,email'.($id != null ? ','.$id : ''),   // to edit or not {if use edit use it}
            'password'=>'required|min:6',
        ];
        if ($id){
            unset($rules['password']);
        }
        return $rules;
    }
}
