<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
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
});

Auth::routes();

Route::group(['middleware'=>'auth'], function () {

    //post resources
    Route::resource('posts',PostController::class);

    //category resources
    Route::resource('categories',CategorieController::class);

    //approve post by admin
    Route::post('approvePost',[AdminController::class, 'approvePost'])->name('approvePost');

    //home page 
    Route::get('home',[HomeController::class, 'index']);

    //get all post by publisher
    Route::get('home/{idPublisher}',[HomeController::class, 'getPostByPublisher']);

    //get all published post
    Route::get('approvedPosts',[HomeController::class, 'getApprovedPost']);

    //get all unpublished post
    Route::get('unapprovedPosts',[HomeController::class, 'getUnapprovedPost']);




});
