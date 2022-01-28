<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContohController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\TravelPackController;
use App\Http\Controllers\TravelFacController;
use App\Http\Controllers\TravelImgController;
use App\Http\Controllers\GoogleController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
    Route::post('/loginuser', [AuthController::class, 'userlogin']);
    Route::post('/loginadmin', [AdminController::class, 'adminlogin']);

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

Route::group(['middleware' => ['auth.jwt']],function ()
{
	Route::get('/contoh', [ContohController::class, 'contoh']);
});

Route::group(['middleware' => ['auth.jwt']],function ()
{
    Route::get('/user-profile', [AuthController::class, 'userProfile']);

    Route::post('/facility', [FacilityController::class, 'create']);
    Route::get('/facility', [FacilityController::class, 'getall']);
    Route::get('/facility/{id}', [FacilityController::class, 'getbyid']);
    Route::post('/facility/{id}', [FacilityController::class, 'update']);
    Route::delete('/facility/{id}', [FacilityController::class, 'delete']);

    Route::post('/travelpack', [TravelPackController::class, 'create']);
    Route::get('/travelpack', [TravelPackController::class, 'getall']);
    Route::get('/travelpack/{id}', [TravelPackController::class, 'getbyid']);
    Route::post('/travelpack/{id}', [TravelPackController::class, 'update']);
    Route::delete('/travelpack/{id}', [TravelPackController::class, 'delete']);

    Route::post('/travelfac', [TravelFacController::class, 'create']);
    Route::get('/travelfac', [TravelFacController::class, 'getall']);
    Route::get('/travelfac/{id}', [TravelFacController::class, 'getbyid']);
    Route::post('/travelfac/{id}', [TravelFacController::class, 'update']);
    Route::delete('/travelfac/{id}', [TravelFacController::class, 'delete']);

    Route::post('/travelimg', [TravelImgController::class, 'create']);
    Route::get('/travelimg', [TravelImgController::class, 'getall']);
    Route::get('/travelimg/{id}', [TravelImgController::class, 'getbyid']);
    Route::post('/travelimg/{id}', [TravelImgController::class, 'update']);
    Route::delete('/travelimg/{id}', [TravelImgController::class, 'delete']);

    Route::get('google', [GoogleController::class, 'redirect']);
    Route::get('google/callback', [GoogleController::class, 'callback']);
});
