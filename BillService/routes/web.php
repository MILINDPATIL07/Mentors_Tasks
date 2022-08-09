<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;


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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/admin',AdminController::class);

Route::get('admin_export',[AdminController::class, 'get_admin_data'])->name('admin.export');

Route::get('/adminaccept/{id}',[AdminController::class,'accept'])->name('admin.approve');
Route::get('/adminactive/{id}',[AdminController::class,'active'])->name('admin.active');
Route::get('/admininactive/{id}',[AdminController::class,'inactive'])->name('admin.inactive');


