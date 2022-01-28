<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;

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

Route::get('/home', function () {
    return view('home');
});
Route::get('/', function () {
    return view('login');
});
Route::get('google', [GoogleController::class, 'redirect']);
Route::get('google/callback', [GoogleController::class, 'callback']);

// Route::get('/loginuser', [AuthController::class, 'userlogin'])->views('welcome');
