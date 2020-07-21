<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Book;
use App\Library;
use App\User;

class Category extends Model
{
    // use SoftDeletes;
    public $table = 'categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'lang','slug','created_at','updated_at','deleted_at'
    ];


    public $dates = ['created_at','updated_at','deleted_at'];
    

    public function getLanguage(){
        if ($this->lang == 'en') {
            return 'English' ;
        } else {
            return 'Arabic' ;
        }
    }

    /*
    *
    ** this All  Relations bettwen category and book and library  
    **
    */
        /**  it is a Category has many book
        *            id    <::>  category_id
        * @return model (one instance)
        *
        **/   
    public function book(){
        return $this->hasOne(Book::class , 'category_id' ,'id');
    }

        /**  it is a Category has many book
        *            id    <::>  category_id
        * 
        * @return collection (many object)
        *
        **/
                
    public function books(){
        return $this->hasMany(Book::class , 'category_id' ,'id');
    }
    
    /**
     * +--------------+----------------+---------------------+
     * |     table    |     table      |        table        |
     * ---------------|----------------|---------------------+
     * |categories    |       books    |       libraries     |
     * |     id  <----|--- category_id |                     |
     * |              |   library_id --|--------> id         |
     * |______________|________________|_____________________|
     */
     public function libraries(){
            return $this->belongsToMany(Library::class, 'books', 'category_id', 'library_id');
     }   
}
