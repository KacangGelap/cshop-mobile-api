<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

// Auth::routes();
Auth::routes(['register' => false, 'password.request'=>false]);
Route::post('/login',[App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->name('masuk');
Route::resource('/product',App\Http\Controllers\productController::class);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
