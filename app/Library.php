<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;
use App\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Library extends Authenticatable
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
