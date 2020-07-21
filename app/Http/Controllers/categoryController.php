<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Library;
use Illuminate\Support\Str;
use File;
use Illuminate\Database\Eloquent\SoftDeletes;

class categoryController extends Controller
{
   

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        // to search 
        $categories = Category::where([]);
        if ($request->has('name')&&$request->input('name') !=null) {
            $categories = $categories->orWhere('name' , 'like' , '%'.$request->input('name').'%');
        }
        if ($request->has('lang')&&$request->input('lang') !='-1') {
            $categories = $categories->orWhere('lang' , 'like' , '%'.$request->input('lang').'%');
        }
        // End search

        $categories = $categories->latest()->paginate(4);
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd( $request->all());
            // Validation
            $request->validate($this->rules());
                

    // save data in DB
      // to img store 
      if($request->hasFile('category_image')){
        // update img
             $imagePath = parent::uploadImage($request->file('category_image'),'image/categories');   
        }

    //   $uploadImage = $request->file('category_image');
    //   $imagename = time(). '.' . $uploadImage->getClientOriginalExtension();
    //   $direction = public_path('/image/');
    //   $uploadImage->move($direction,$imagename);
    //   $imagePath = 'image/' . $imagename ; 

    //   create
        // $category = new Category();
        // $category->name = $request->input('name'); // store name
        // $category->lang = $request->input('lang'); // store language
        // $category->slug = Str::slug($request->input('name'));//store slug use name
        // $category->image = $imagePath; // store name
        // $category->save();//to save to dataBase

        /*
        **
            other way any one use
        **
        */  
        
        $request['image'] = $imagePath ;
        $request['slug'] = Str::slug($request->input('name'));
        Category::create($request->all());
        

    return redirect()->back()
                    ->with('success',__('category.messages.createdSuccessfully'));
                    // ->with('success',"Category { {$request['name']} } created successfully.");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::whereSlug($slug)->firstOrFail();
        return view('category.show',compact('category'));
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
            $category = Category::whereSlug($slug)->firstOrFail();
             // old name
             $oldName = $category->name;
            return view('category.edit',compact('category'));
        } catch (\Throwable $th) {
            return redirect()->back()
                    ->with('error', __('category.messages.notFound'));
                    // ->with('error',"Category { $oldName } not found ");
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        try {
            // find category
            $category = Category::findOrFail($slug);
             // Validation
            $request->validate($this->rules($slug));
            // old name
            $oldName = $category->name;

            $category->name = $request->input('name'); // store name
            $category->lang = $request->input('lang'); // store language
            $category->slug = Str::slug($request->input('name'));//store slug use name
            if($request->hasFile('category_image')){
                    // update img
                   $imagePath = parent::uploadImage($request->file('category_image'),'image/categories');
                   // remove old image
                   if(File::exists( public_path($category->image))){
                        File::delete(public_path($category->image));
                    }
                   $category->image = $imagePath;
            }
            $category->update();
            return redirect('/category')
                     ->with('success', __('category.messages.updatedSuccessfully'));
                    //  ->with('success',"Category { $oldName } Updated successfully. ");

        } catch (\Throwable $th) {
                    return redirect()->back()
                            ->with('error', __('category.messages.notFound'));
        }
    }


     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category =  Category::findOrFail($id);
        $oldName = $category->name ;

        /**  to delete the image also
         **
         ** if use soft deletes delete this code 
         */
        if(File::exists( public_path($category->image))){
            File::delete(public_path($category->image));
        }
        $category->delete();
  
        return redirect()->route('category.index')
                        ->with('success', __('category.messages.deletedSuccessfully'));
                        // ->with('success',"category { $oldName } deleted successfully");
    }


    // method to help 
    private function rules($slug= null){
        $rules = [
            'lang' => 'in:en,ar'
        ];
        if($slug){
            $rules['name'] = 'required|min:3|max:50|unique:categories,name,' . $slug ;
            $rules['category_image'] = 'mimes:png,jpg,jpeg' ;
        }else {
            $rules['name'] = 'required|min:3|max:50|unique:categories,name' ;
            $rules['category_image'] = 'required|mimes:png,jpg,jpeg' ;
        }

        return $rules;
    }

   
}
