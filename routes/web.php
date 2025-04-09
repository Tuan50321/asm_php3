<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// trang chủ
Route::get('/', function () {
    return view('client.home');
});
// login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

//logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// phân quyền cho user
Route::middleware('client')->group(function () {
    Route::get('/list', [HomeController::class, 'list'])->name('client.list');
    Route::get('/show/{id}', [HomeController::class, 'show'])->name('client.show');
});

// phân quyền cho admin
Route::middleware('admin')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});