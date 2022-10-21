<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\LoginController;
use Modules\Auth\Http\Controllers\RegisterController;
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Http\Controllers\UserController;
use Modules\Auth\Http\Controllers\EmailVerifyController;
use Modules\Auth\Http\Controllers\backoffice\UserController as backofficeUserController;

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

Route::middleware('auth:api')->get('/auth', function (Request $request) {
    return $request->user();
});
Route::prefix('v1/auth')->group(function () {
    Route::post('login',[LoginController::class,"login"]);
    Route::get('logout',[UserController::class,'logout']);
    Route::post('register',[RegisterController::class,"register"]);
    Route::patch("refresh",[AuthController::class,"refresh_token"]);
    // Route::prefix('users')->group(function(){
    //     Route::patch('update',[UserController::class,'update']);
    //     Route::delete('delete',[UserController::class,'delete']);
    // });
    // Route::prefix('backoffice')->group(function(){
    //     Route::prefix('users')->group(function(){
    //         Route::get('/',[backofficeUserController::class,'index']);
    //         Route::patch('{id}/update',[backofficeUserController::class,'update']);
    //         Route::delete('{id}/delete',[backofficeUserController::class,'delete']);
    //     });
    // });
    Route::get('email/{id}/verify',[EmailVerifyController::class,"verify"])->middleware('signed')->name('email-verification');
});