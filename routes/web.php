<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {return view('welcome');});
Route::get('/create', function () {return view('page.user.userRegistration');});


