<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::prefix('categories')->group(function () {
    Route::post('/', [CategoryController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('{category}/meals', [MealController::class, 'byCategory']);
    Route::put('{category}', [CategoryController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('{category}', [CategoryController::class, 'destroy'])->middleware('auth:sanctum');
});

Route::prefix('meals')->group(function () {
    Route::post('/', [MealController::class, 'store'])->middleware('auth:sanctum');
    Route::get('/', [MealController::class, 'index']);
    Route::put('{meal}', [MealController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('{meal}', [MealController::class, 'destroy'])->middleware('auth:sanctum');
});

// Route::get('/test', function () {
//     return 'API is working';
// });
