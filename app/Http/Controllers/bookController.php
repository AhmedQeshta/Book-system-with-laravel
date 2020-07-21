<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library;
use App\Category;
use App\Book;
use Illuminate\Support\Str;
use File;
use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;

class bookController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // to search 
         $books = Book::where([]);
         if ($request->has('title')&&$request->input('title') !=null) {
             $books = $books->orWhere('title' , 'like' , '%'.$request->input('title').'%');
         }
         if ($request->has('author')&&$request->input('author') !=null) {
            $books = $books->orWhere('author' , 'like' , '%'.$request->input('author').'%');
        }
         // End search
 
         $books = $books->latest()->paginate(4);
         return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $libraries = Library::all();
        return view('book.create', compact(['categories','libraries']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

         // Validation
         $request->validate($this->rules());
        // save data in DB
        // to img store 
        if($request->hasFile('book_image')){
         // update img
            $imagePath = parent::uploadImage($request->file('book_image'),'image/books');   
        }
        $request['image'] = $imagePath ;
        $request['slug'] = Str::slug($request->input('title'));
        $request['library_id'] = $request['library_id'];
        $request['category_id'] = $request['category_id'];
        Book::create($request->all());

        return redirect()->back()
                 ->with('success',__('book.messages.createdSuccessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $categories = Category::all();
        $libraries = Library::all();
        $books = Book::whereSlug($slug)->firstOrFail();
        return view('book.show',compact(['books','categories','libraries']));
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
            $book = Book::whereSlug($slug)->firstOrFail();
            $categories = Category::all();
            $libraries = Library::all();
            
            return view('book.edit',compact(['book','categories','libraries']));
        } catch (\Throwable $th) {
            return redirect()->back()
                                               // old name
                    ->with('error',__('book.messages.notFound'));
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
        // dd($request['category_id']);
        // $categories = Category::all();
        // $libraries = Library::all();
        // find category
        $books = Book::findOrFail($slug);
         // Validation
        $request->validate($this->rules($slug));

        if($request->hasFile('book_image')){
                // update img
                $imagePath = parent::uploadImage($request->file('book_image'),'image/books');
                // remove old image
                if(File::exists( public_path($books->image))){
                    File::delete(public_path($books->image));
                }
                $books->image = $imagePath;
                $request['image'] = $imagePath ;
        }
       
        
        $request['slug'] = Str::slug($request->input('title'));
        $request['library_id'] = $request['library_id'];
        $request['category_id'] = $request['category_id'];
        $books->update($request->all());
            return redirect('/book')
                     ->with('success',__('book.messages.updatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $books =  Book::findOrFail($id);
        

        /**  to delete the image also
         **
         ** if use soft deletes delete this code 
         */
        if(File::exists(public_path($books->image))){
            
            File::delete(public_path($books->image));
        }
        $books->delete();
  
        return redirect()->route('book.index')
                        ->with('success',__('book.messages.deletedSuccessfully'));
    }

     // method to help 
     private function rules($slug= null){
        $rules = [
            // 'title'=> 'min:3|max:50',
            // 'author'=> 'min:3|max:50',
            // 'writer'=> 'min:3|max:50',
            // 'publisher'=> 'min:3|max:50',
        ];
        if($slug){
            $rules['title'] = 'required|min:3|max:50|unique:books,title,' . $slug ;
            $rules['author'] = 'required|min:3|max:50';
            $rules['writer'] = 'required|min:3|max:50' ;
            $rules['publisher'] = 'required|min:3|max:50';
            $rules['book_image'] = 'mimes:png,jpg,jpeg' ;
        }else {
            $rules['title'] = 'required|min:3|max:50|unique:books,title' ;
            $rules['author'] = 'required|min:3|max:50';
            $rules['writer'] = 'required|min:3|max:50';
            $rules['publisher'] = 'required|min:3|max:50';
            $rules['book_image'] = 'required|mimes:png,jpg,jpeg';
        }

        return $rules;
    }
}
