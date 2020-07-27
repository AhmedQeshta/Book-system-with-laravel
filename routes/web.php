<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// main
Route::get('/', function () {return view('welcome');});
Route::get('/test', function () {return view('test');})->name('test')->middleware(['auth:admin']);



// new category
Route::group(['prefix' => 'category' , 'middleware'=>['auth:admin']], function () {
    Route::get('/','categoryController@index')->name('category.index');
    Route::get('create','categoryController@create')->name('category.create');
    Route::post('store','categoryController@store')->name('category.store');
    Route::get('edit/{id}','categoryController@edit')->name('category.edit');
    Route::put('update/{slug}','categoryController@update')->name('category.update');
    Route::get('destroy/{id?}','categoryController@destroy')->name('category.destroy');
    // ajax response
    Route::post('book/count/{id?}','categoryController@bookCount')->name('category.book.count');  
});

// new Libraries
Route::group(['prefix' => 'library' ,'middleware'=>['auth:library']], function () {
    Route::get('/','libraryController@index')->name('library.index');
    Route::get('create','libraryController@create')->name('library.create');
    Route::post('store','libraryController@store')->name('library.store');
    Route::get('edit/{id}','libraryController@edit')->name('library.edit');
    Route::put('update/{slug}','libraryController@update')->name('library.update');
    Route::get('destroy/{id?}','libraryController@destroy')->name('library.destroy');
    // Route::get('/logout', 'Auth\adminLoginController@librarylogout')->name('library.logout'); 

    // ajax response
    Route::post('library/count/{id?}','libraryController@libraryCount')->name('library.book.count');
});

// new Libraries
Route::group(['prefix' => 'book' , 'middleware'=>['auth:admin'] ], function () {
    Route::get('/','bookController@index')->name('book.index');
    Route::get('create','bookController@create')->name('book.create');
    Route::post('store','bookController@store')->name('book.store');
    Route::get('edit/{id}','bookController@edit')->name('book.edit');
    Route::put('update/{slug}','bookController@update')->name('book.update');
    Route::get('destroy/{id?}','bookController@destroy')->name('book.destroy');  
});

Route::get('local/{lang?}', 'localizationController@change')->name('local.change');


// auth
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

// last mult auth 
Route::group(['prefix' => 'user' ], function () {
    Route::get('/', 'userController@index')->name('user');
    // Route::get('/logout', 'Auth\LoginController@userlogout')->name('user.logout');
});

// new Libraries
Route::group(['prefix' => 'admin' ], function () {
    Route::get('/', 'adminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\adminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\adminLoginController@login')->name('admin.login.submit');    
    // Route::get('/logout', 'Auth\adminLoginController@logout')->name('admin.logout'); 
  
    // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});


// log out 
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// Map in my project
Route::group(['prefix' => 'map' ], function () {
    Route::get('/', 'MapController@showMap')->name('map');
    Route::post('/store','MapController@store')->name('mapLocation.store');
});

// Map in my project
Route::group(['prefix' => 'mail' ], function () {
    Route::get('/send', 'MailController@send')->name('mail.send');
});

// fire base 
// Route::get('puch/firebase','FireBaseController@puch')->name('firebase.puch');