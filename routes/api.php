<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//user
Route::post('user/register', [App\Http\Controllers\Api\UserController::class, 'register']);
Route::post('user/login', [App\Http\Controllers\Api\UserController::class, 'login']);
Route::post('user/update', [App\Http\Controllers\Api\UserController::class, 'update']);
Route::post('user/checkEmailExist', [App\Http\Controllers\Api\UserController::class, 'checkEmailExist']);
Route::post('user/update', [App\Http\Controllers\Api\UserController::class, 'update']);

//item
Route::get('item', [App\Http\Controllers\Api\OrderController::class, 'getItem']);
Route::get('advertisement', [App\Http\Controllers\Api\OrderController::class, 'getadds']);

//order
Route::post('placeOrder', [App\Http\Controllers\Api\OrderController::class, 'placeOrder']);
Route::get('order/{student_id}', [App\Http\Controllers\Api\OrderController::class, 'getOrder']);
