<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

// ketika pertama kali dibuka
Route::get('/home', function () {
    return view('auth.login');
});

// berhasil login masuk ke home dashboard
Route::get('/', 'HomeController@index')->name('home');

// route manage users
Route::resource('data-users', 'UserController');
Route::resource('create-users', 'UserController');
Route::resource('edit-user', 'UserController');
Route::resource('delete-user', 'UserController');
Route::resource('details-user', 'UserController');


Route::get('/categories/trash', 'CategoryController@trash')->name('categories-trash');

Route::get('/categories/{id}/restore', 'CategoryController@restore')->name('categories-restore');

Route::delete('categories/{id}/delete-permanent', 'CategoryController@deletePermanent')->name('permanent');

// route categories
Route::resource('categories', 'CategoryController');


Auth::routes();
