<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Auths
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// Products
Route::middleware('auth:sanctum')->group( function(){
    Route::get('/products',[APIController::class, 'products_index'])->name('produk.index');
    Route::get('/products/{id}',[APIController::class, 'products_show'])->name('produk.show');    
    //user-based
    Route::get('/profile/{id}',[APIController::class, 'user_profile'])->name('user.profile');
    Route::get('/user_cart',[APIController::class, 'user_cart'])->name('cart.show');
    Route::post('/cart',[APIController::class, 'add_to_cart'])->name('cart.add');    
});


