<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaptchaServiceController;


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

Route::get('/web-register', [CaptchaServiceController::class, 'webRegister']);
Route::post('/web-register', [CaptchaServiceController::class, 'webRegisterPost']);

// Route::get('web-register', 'Auth\AuthController@webRegister');

// Route::post('web-register', 'Auth\AuthController@webRegisterPost');
