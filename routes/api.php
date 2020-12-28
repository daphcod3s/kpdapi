<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CuisineController;
use App\Http\Controllers\Api\RestaurantController;

Route::group(['prefix' => 'auth'], function(){
	Route::post('login', [AuthController::class, 'login']);
	Route::post('logout', [AuthController::class, 'logout']);
	Route::post('refresh', [AuthController::class, 'refresh']);
	Route::get('profile', [AuthController::class, 'profile']);
});

Route::resource('cuisine', CuisineController::class);
Route::resource('restaurant', RestaurantController::class);