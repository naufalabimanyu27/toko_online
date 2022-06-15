<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class,'index']);
Route::get('/product', [ProductController::class,'index']);
Route::get('/detail/{id}', [ProductController::class,'detail']);
//USER ORDER
Route::post('/order/{id}', [OrderController::class,'pesan']);
Route::get('/listorder/{id}', [OrderController::class,'index']);
Route::post('/delete_order/{id}', [OrderController::class,'destroy']);
Route::post('/upload_bukti_bayar/{id}', [OrderController::class,'store']);
//LOGIN
Route::get('/login', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class,'autentikasi']);
//LOGOUT
Route::post('/logout', [LoginController::class,'logout']);
//REGISTER
Route::get('/register', [RegisterController::class,'index'])->middleware('guest');
Route::post('/register', [RegisterController::class,'store']);
//DASHBOARD ADMIN
Route::get('/dashboard', [DashboardController::class,'index']);
Route::get('/edit_user/{id}', [DashboardController::class,'edit']);
Route::post('/update_user/{id}', [DashboardController::class,'update']);
Route::post('/delete_user/{id}', [DashboardController::class,'destroy']);
//DASHBOARD PRODUCT
Route::get('/dashboardproduct', [ProductController::class,'dashboard']);
Route::get('/add_product', [ProductController::class,'create']);
Route::post('/add_product', [ProductController::class,'store']);
Route::get('/edit_product/{id}', [ProductController::class,'edit']);
Route::post('/update_product/{id}', [ProductController::class,'update']);
Route::post('/delete_product/{id}', [ProductController::class,'destroy']);
//DASHBOARD ORDER
Route::get('/dashboardorder', [OrderController::class,'dashboard']);
Route::post('/terima_bayar/{id}', [OrderController::class,'bayar']);