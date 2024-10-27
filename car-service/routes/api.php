<?php

use App\Http\Controllers\CarsController;
use App\Http\Middleware\ValidateToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::group(['middleware'=> ValidateToken::class], function () {
    Route::resource('cars', CarsController::class)->except(['create', 'edit'])->parameter('car', 'car');
});
