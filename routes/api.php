<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::apiResource('/clients', ClientController::class);

    Route::post('/logout', LogoutController::class);
});

Route::post('/login', LoginController::class);
