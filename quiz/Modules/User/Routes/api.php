<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Modules\User\Http\Controllers\UserController;
use Modules\User\Http\Controllers\backoffice\UserController as backofficeUserController;

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
Route::prefix('v1')->group(function () {
    Route::prefix('users')->group(function(){
        Route::patch('update',[UserController::class,'update']);
        Route::delete('delete',[UserController::class,'delete']);
    });
    Route::prefix('backoffice')->group(function(){
        Route::prefix('users')->group(function(){
            Route::get('/',[backofficeUserController::class,'index']);
            Route::patch('{id}/update',[backofficeUserController::class,'update']);
            Route::delete('{id}/delete',[backofficeUserController::class,'delete']);
        });
    });
});