<?php

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
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::post(
    '/register', 
    [AuthController::class, 'register']
)->name('login');

Route::post(
    '/login', 
    [AuthController::class, 'login']
)->name('login');

Route::post(
    '/logout', 
    [AuthController::class, 'logout']
)->name('logout');

Route::get(
    '/profile', 
    [ProfileController::class, 'view_profile']
)->name('view_profile');

Route::put(
    '/profile', 
    [ProfileController::class, 'edit_profile']
)->name('edit_profile');
