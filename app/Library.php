<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;
use App\User;
class Library extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'email','phone','password','slug' 
    ];

    public function book(){
        return $this->hasMany(Book::class , 'library_id' ,'id');
    }
}
