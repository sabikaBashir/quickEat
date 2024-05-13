<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


Route::get('test_mongodb/', function (Request $request) {
    $msg = "ok";
    try{
    $connection = DB::connection('mongodb');
    $connection->command(['ping'=>1]);
    }catch(\Exception $e){
        $msg = $e->getMessage();
    }
    return ['msg' =>$msg];
});


Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::get('login', [App\Http\Controllers\HomeController::class, 'login'])->name('login');
Route::post('post-login', [App\Http\Controllers\HomeController::class, 'postLogin'])->name('login.post'); 
Route::get('logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
Route::get('edit-profile', [App\Http\Controllers\HomeController::class, 'editProfile'])->name('edit-profile');
Route::post('update-profile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');

//user managment

Route::resource('users', App\Http\Controllers\StudentController::class);

//advertisment
Route::get('adds\Approve\{id}\{status}', [App\Http\Controllers\AdvertisementController::class,'editApprovel'])->name('adds.approve');
Route::resource('advertisement', App\Http\Controllers\AdvertisementController::class);

//category
Route::resource('category', App\Http\Controllers\CategoryController::class);

//item
Route::resource('item', App\Http\Controllers\ItemController::class);

//vendor
Route::resource('vendor', App\Http\Controllers\VendorController::class);

//order
Route::get('order/getOrder', [App\Http\Controllers\OrderController::class,'get_order'])->name('get.order');
Route::get('order/OrderDetail/{id}', [App\Http\Controllers\OrderController::class,'get_order_detail'])->name('get.order.detail');
Route::post('order/UpdateStatus/{id}', [App\Http\Controllers\OrderController::class,'update_order_status'])->name('order.update.status');
