<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RestaurantController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Public Routes
Route ::get('location',([LocationController::class,'index']));
Route ::post ('/location',[LocationController::class,'createLocation']);
Route::get ('/location/{id}',[LocationController::class,'getLocation']);
Route::put ('/location/{id}',[LocationController::class,'updateLocation']);
Route::delete ('/location/{id}',[LocationController::class,'deleteLocation']);
Route::get ('/location/search/{name}',[LocationController::class,'searchLocation']);


Route::get('restaurant', [RestaurantController::class, 'index']);
Route::post('/restaurant', [RestaurantController::class, 'createRestaurant']);
Route::get('/restaurant/{id}', [RestaurantController::class, 'getRestaurant']);
Route::put('/restaurant/{id}', [RestaurantController::class, 'updateRestaurant']);
Route::delete('/restaurant/{id}', [RestaurantController::class, 'deleteRestaurant']);
