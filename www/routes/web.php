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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Auth::routes();
Route::get('/', 'HomeController@index')->name('/');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/AdminDashboard', 'HomeController@adminhome')->name('home.admin.index');
Route::get('/UserDashboard', 'HomeController@userhome')->name('home.user.index');

Route::post('/UserDashboard/AddPlan', 'HomeController@userAddPlan')->name('home.user.addPlan');
Route::post('/UserDashboard/AddDiary', 'HomeController@userAddDiary')->name('home.user.addDiary');

