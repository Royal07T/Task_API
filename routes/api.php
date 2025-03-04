<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;  // Make sure to import the TaskController with its namespace

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Using the apiResource to handle all CRUD operations for Task
Route::apiResource('tasks', TaskController::class);
