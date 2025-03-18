<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductManagementController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\UserManagementController;

Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/products', [PageController::class, 'products']);
Route::get('/blogs', [PageController::class, 'blogs']);
Route::get('/order-our-product', [PageController::class, 'order']);

Route::post('submit-order',[OrderController::class,'submitOrder']);

//Authentification or User Login
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('CheckAuth');
Route::post('/login',[AuthController::class,'authenticate']);
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

//Dashboard Page
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/order/detail/{order_id}', [OrderController::class, 'show']);

//Product
Route::get('/product-management', [ProductManagementController::class, 'index'])->middleware('CheckAuth');
Route::get('/product-management/create', [ProductManagementController::class, 'create'])->middleware('CheckAuth');
Route::post('/product-management/store',[ProductManagementController::class,'store']);
Route::get('/product-management/edit/{id}', [ProductManagementController::class, 'edit'])->middleware('CheckAuth');
Route::post('/product-management/update',[ProductManagementController::class,'update']);
Route::get('/product-management/delete/{id}', [ProductManagementController::class, 'destroy']);

//Navigation Management
Route::get('/navigation-management', [NavigationController::class, 'index'])->middleware('CheckAuth');
Route::get('/navigation-management/create', [NavigationController::class, 'create'])->middleware('CheckAuth');
Route::post('/navigation-management/store',[NavigationController::class,'store']);
Route::get('/navigation-management/edit/{id}', [NavigationController::class, 'edit'])->middleware('CheckAuth');
Route::post('/navigation-management/update',[NavigationController::class,'update']);
Route::get('/navigation-management/delete/{id}', [NavigationController::class, 'destroy']);

//User Management
Route::get('/user-management', [UserManagementController::class, 'index'])->middleware('CheckAuth');
Route::get('/user-management/create', [UserManagementController::class, 'create'])->middleware('CheckAuth');
Route::post('/user-management/store',[UserManagementController::class,'store']);
Route::get('/user-management/edit/{id}', [UserManagementController::class, 'edit'])->middleware('CheckAuth');
Route::post('/user-management/update',[UserManagementController::class,'update']);
Route::get('/user-management/delete/{id}', [UserManagementController::class, 'destroy']);
