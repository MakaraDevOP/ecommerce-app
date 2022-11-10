<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

// User 
Route::post('/register' , [AuthController::class, 'register']);
Route::post('/login' , [AuthController::class, 'login']);

// Protect 
Route::group(['middleware' => ['auth:sanctum']] , function(){
  Route::get('/user/get', [AuthController::class, 'get']);
  Route::post('/logout' , [AuthController::class, 'logout']);

  // Product
  Route::prefix('product')->group(function () {
    Route::post('/create' , [ProductController::class, 'store']);
});


});