<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/weather-request', [WeatherController::class, 'submitLocation'])
    ->middleware('throttle:10,1');
Route::get('/weather-data', [WeatherController::class, 'getWeather']);
