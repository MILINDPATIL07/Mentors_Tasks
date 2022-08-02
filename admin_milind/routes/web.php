<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


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

// Route::get('/', function () {
//     return view('dashboard');
// });

Auth::routes();

Route::resource('admin', AdminController::class);

Route::resource('category', CategoryController::class);

Route::resource('product', ProductController::class);

Route::get('/', [HomeController::class, 'dashboard']);

Route::get('/filter', [HomeController::class, 'filterproduct'])->name('filter');


//Auth::routes();

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
// Route::middleware(['auth', 'user-access:user'])->group(function () {

//     Route::get('/home', [HomeController::class, 'index'])->name('home');
// });

/*------------------------------------------
--------------------------------------------
All Super Admin Routes List
--------------------------------------------
--------------------------------------------*/
// Route::middleware(['auth', 'user-access:super-admin'])->group(function () {

//     Route::get('/super-admin/home', [HomeController::class, 'superAdminHome'])->name('super.admin.home');
// });
