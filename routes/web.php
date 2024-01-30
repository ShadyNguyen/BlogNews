<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;


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
//auth
Route::get('/login',[LoginController::class,'showLoginForm'])->name('showLoginForm');
Route::post('/login',[LoginController::class,'login'])->name('login');
Route::get('/register',[RegisterController::class,'showRegisterForm'])->name('showRegisterForm');
Route::post('/register',[RegisterController::class,'create'])->name('register');
Route::get('logout',[LoginController::class,'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home',[HomeController::class,'index'])->name('home');
    Route::resource('category', CategoryController::class);
    Route::resource('post',PostController::class);
});