<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// User 
Route::post('/register' , [AuthController::class, 'register']);
Route::post('/login' , [AuthController::class, 'login']);

// Protect 
Route::group(['middleware' => ['auth:sanctum']] , function(){
  Route::get('/user/get', [AuthController::class, 'get']);
  Route::post('/logout' , [AuthController::class, 'logout']);

  // Product
  Route::group('product', function(){

    Route::post('/create' , [AuthController::class, 'logout']);
  });


});