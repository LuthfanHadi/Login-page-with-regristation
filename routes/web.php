<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
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

Route::get('/', function () {
    return view('welcome');
});

//LOGIN
Route::get('/main','App\Http\Controllers\MainController@index');
Route::post('/main/checklogin', 'App\Http\Controllers\MainController@checklogin');
Route::get('main/successlogin', 'App\Http\Controllers\MainController@successlogin');
Route::get('main/logout', 'App\Http\Controllers\MainController@logout');

//SIGNUP
Route::get('/main/signup', 'App\Http\Controllers\MainController@signup');
Route::post('/main/checksignup', 'App\Http\Controllers\MainController@checksignup');
Route::get('main/successsignup', 'App\Http\Controllers\MainController@successsignup');

