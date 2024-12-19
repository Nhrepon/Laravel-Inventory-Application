<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerifyMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/createUser', [UserController::class, 'createUser']);
Route::get('/userLogin', [UserController::class, 'userLogin']);
Route::get('/sendOtp', [UserController::class, 'sendOtp']);
Route::get('/verifyOtp', [UserController::class, 'verifyOtp']);
Route::get('/passwordReset', [UserController::class, 'passwordReset'])->middleware(TokenVerifyMiddleware::class);


