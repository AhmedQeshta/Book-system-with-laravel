<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{

       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest:library')->except('logout');
      $this->middleware('guest:admin')->except('logout');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin');
    }


   
}
