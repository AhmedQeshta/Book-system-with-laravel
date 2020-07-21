<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Library;
use App\User;
use App\Category;

class Book extends Model{

    protected $fillable = [
        'name', 'slug', 'library_id', 
        'category_id','title','author',
        'writer','publisher','publisher_time',
        'image'
    ];

    
    /*
    *
    ** this All  Relations bettwen book and Category and library  
    **
    */
        /**  it is  book  belongsTo Category 
        *            id    <::>  category_id
        * @return model (one instance)
        *
        **/   
        public function category(){    
            return $this->belongsTo(Category::class , 'category_id' ,'id');
        }

        /**  it is  book  belongsTo library 
        *            id    <::>  category_id
        * @return model (one instance)
        *
        **/   
        public function library(){    
            return $this->belongsTo(Library::class , 'library_id' ,'id');
        }
        

    
}
