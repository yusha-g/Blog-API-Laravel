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
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});


//AUTHENTICATION ROUTES

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

//PROFILE ROUTES

Route::get(
    '/profile', 
    [ProfileController::class, 'view_profile']
)->name('view_profile');

Route::put(
    '/profile', 
    [ProfileController::class, 'edit_profile']
)->name('edit_profile');

//ARTICLE ROUTES

Route::get(
    '/articles', 
    [ArticleController::class, 'check_article_access']
)->name('check_article_access');

Route::post(
    '/articles', 
    [ArticleController::class, 'create_article']
)->name('create_article');

Route::get(
    '/articles/{article_id}', 
    [ArticleController::class, 'read_article']
)->name('read_article');

Route::put(
    '/articles/{article_id}', 
    [ArticleController::class, 'update_article']
)->name('update_article');

Route::delete(
    '/articles/{article_id}', 
    [ArticleController::class, 'delete_article']
)->name('delete_article');