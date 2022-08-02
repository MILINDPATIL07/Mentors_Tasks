<?php

use Illuminate\Support\Facades\Route;
use  Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('home');

Route::resource('/admin',AdminController::class);

Route::get('admin_export',[AdminController::class, 'get_admin_data'])->name('admin.export');

Route::resource('category', CategoryController::class);
Route::get('category_export',[CategoryController::class, 'get_category_data'])->name('category.export');


Route::resource('/articles', ArticlesController::class);

Route::get('article_export',[ArticlesController::class, 'get_article_data'])->name('articles.export');

// Route::get('/articles/{article:articles}',[ArticlesController::class, 'show'])->name('articles.show');

Route::get('/adminaccept/{id}',[AdminController::class,'accept'])->name('admin.accept');


Route::post('/comment/store',[CommentController::class,'store'])->name('comment.add');

Route::post('/reply/store',[CommentController::class,'replyStore'])->name('reply.add');

Route::get('/filter', [HomeController::class, 'filterproduct'])->name('filter');

