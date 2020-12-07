<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('succ-logged');

Route::post('user/register',[App\Http\Controllers\AuthorizationController::class, 'register'])->name('auth.custom.register')
->middleware('guest-logged');
Route::post('user/login',[App\Http\Controllers\AuthorizationController::class, 'login'])->name('auth.custom.login')
->middleware('guest-logged');
Route::post('user/reset-password',[App\Http\Controllers\AuthorizationController::class, 'resetPassword'])->name('auth.custom.reset-password')
->middleware('guest-logged');
Route::post('user/reset-password',[App\Http\Controllers\AuthorizationController::class, 'logout'])->name('auth.custom.logout')
->middleware('succ-logged');