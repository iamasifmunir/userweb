<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ApiController;

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


Route::post('/login', [ApiController::class, 'login']);


Route::group(['prefix' => '/', 'middleware' => 'auth":"api'], function(){



});
Route::get('/list', [ApiController::class, 'index']);
Route::post('/create-post', [ApiController::class, 'create']);

