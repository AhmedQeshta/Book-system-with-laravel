<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library;
use App\Category;
use Illuminate\Support\Str;
use File;
use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;

class libraryController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         // to search 
         $libraries = Library::where([]);
         if ($request->has('name')&&$request->input('name') !=null) {
             $libraries = $libraries->orWhere('name' , 'like' , '%'.$request->input('name').'%');
         }
         // End search
 
         $libraries = $libraries->latest()->paginate(4);
         return view('library.index', compact('libraries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('library.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate($this->rules());

      // save data in DB
      // to img store 
      if($request->hasFile('library_image')){
        // update img
             $imagePath = parent::uploadImage($request->file('library_image'),'image/libraries');   
        }

        $request['image'] = $imagePath ;
        $request['slug'] = Str::slug($request->input('name'));
        $request['password'] = Hash::make($request->input('password'));
        Library::create($request->all());
        

    return redirect()->back()
                    ->with('success',__('library.messages.createdSuccessfully'));

    }

    /**
     * Display the specified resource.
     *
     * @param  str  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $library = Library::whereSlug($slug)->firstOrFail();
        return view('library.show',compact('library'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        try {
            $library = Library::whereSlug($slug)->firstOrFail();
             // old name
             $oldName = $library->name;
            return view('library.edit',compact('library'));
        } catch (\Throwable $th) {
            return redirect()->back()
                    ->with('error',__('library.messages.notFound'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug){

      
            // find category
            $libraries = Library::findOrFail($slug);
             // Validation
            $request->validate($this->rules($slug));

            $libraries->name = $request->input('name'); // store name
            $libraries->email = $request->input('email'); // store email
            $libraries->password = Hash::make($request->input('password'));  // store email
            $libraries->phone = $request->input('phone'); // store phone
            $libraries->slug = Str::slug($request->input('name'));//store slug use name
            if($request->hasFile('library_image')){
                    // update img
                   $imagePath = parent::uploadImage($request->file('library_image'),'image/libraries');
                   // remove old image
                   if(File::exists( public_path($libraries->image))){
                        File::delete(public_path($libraries->image));
                    }
                   $libraries->image = $imagePath;
            }
            $libraries->update();
            return redirect('/library')
                     ->with('success',__('library.messages.updatedSuccessfully'));

      

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $libraries =  Library::findOrFail($id);
        $oldName = $libraries->name ;

        /**  to delete the image also
         **
         ** if use soft deletes delete this code 
         */
        if(File::exists(public_path($libraries->image))){
            
            File::delete(public_path($libraries->image));
        }
        $libraries->delete();
  
        return redirect()->route('library.index')
                        ->with('success',__('library.messages.deletedSuccessfully'));
    }

      // method to help 
      private function rules($slug= null){
        $rules = [
            'password'  => 'min:6|max:25'
        ];
        if($slug){
            $rules['name'] = 'required|min:3|max:50|unique:libraries,name,' . $slug ;
            $rules['email'] = 'required|string|email|min:3|max:100|unique:libraries,email,' . $slug ;
            $rules['phone'] = 'required|min:10|max:11|unique:libraries,phone,' . $slug ;
            $rules['password'] = '' ;
            $rules['library_image'] = 'mimes:png,jpg,jpeg' ;
        }else {
            $rules['name'] = 'required|min:3|max:50|unique:libraries,name' ;
            $rules['email'] = 'required|min:3|max:100|unique:libraries,email' ;
            $rules['phone'] = 'required|min:10|max:11|unique:libraries,phone' ;
            $rules['password'] = 'required|min:6|max:25' ;
            $rules['library_image'] = 'required|mimes:png,jpg,jpeg' ;
        }

        return $rules;
    }

    // Libraries Count 
    public function libraryCount($id){
        try {
            $library = Library::findOrFail($id);
            $librarycont = $library->book()->count();
            return response()->json(['status' => '200' , 'message'=> $librarycont]);
        } catch (\Throwable $th) {
            return response()->json(['status' => '404' , 'message'=> 'Not Found']);
        }
     
    }
}
