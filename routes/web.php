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
Route::get('/test', function () {return view('test');})->name('test');



// new category
Route::group(['prefix' => 'category'], function () {
    Route::get('/','categoryController@index')->name('category.index');
    Route::get('create','categoryController@create')->name('category.create');
    Route::post('store','categoryController@store')->name('category.store');
    Route::get('edit/{id}','categoryController@edit')->name('category.edit');
    Route::put('update/{slug}','categoryController@update')->name('category.update');
    Route::get('destroy/{id?}','categoryController@destroy')->name('category.destroy');
    // Route::get('/show/{id}','categoryController@show')->name('category.show');     
});

// new Libraries
Route::group(['prefix' => 'library'], function () {
    Route::get('/','libraryController@index')->name('library.index');
    Route::get('create','libraryController@create')->name('library.create');
    Route::post('store','libraryController@store')->name('library.store');
    Route::get('edit/{id}','libraryController@edit')->name('library.edit');
    Route::put('update/{slug}','libraryController@update')->name('library.update');
    Route::get('destroy/{id?}','libraryController@destroy')->name('library.destroy');
    // Route::get('/show/{id}','libraryController@show')->name('library.show');     
});

// new Libraries
Route::group(['prefix' => 'book' ], function () {
    Route::get('/','bookController@index')->name('book.index');
    Route::get('create','bookController@create')->name('book.create');
    Route::post('store','bookController@store')->name('book.store');
    Route::get('edit/{id}','bookController@edit')->name('book.edit');
    Route::put('update/{slug}','bookController@update')->name('book.update');
    Route::get('destroy/{id?}','bookController@destroy')->name('book.destroy');
    // Route::get('/show/{id}','bookController@show')->name('book.show');     
});

Route::get('local/{lang?}', 'localizationController@change')->name('local.change');

// auth
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
