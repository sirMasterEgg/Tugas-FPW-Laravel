<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TokoController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/login', 301);

Route::get('/logout', [SiteController::class, 'doLogout'])->name('logout');

Route::get('/login', [SiteController::class, 'login'])->name('login');
Route::post('/login', [SiteController::class, 'doLogin'])->name('doLogin');

Route::prefix('customer')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('customer-index');
    Route::get('/register', [CustomerController::class, 'register'])->name('customer-register');
    Route::post('/register', [CustomerController::class, 'doRegister'])->name('customer-doregister');
    Route::get('/profile', [CustomerController::class, 'getProfile'])->name('customer-profile');
    Route::post('/profile', [CustomerController::class, 'doEditProfile'])->name('customer-doEditProfile');
    Route::get('/history', [CustomerController::class, 'getHistory'])->name('customer-history');
});

Route::prefix('toko')->group(function () {
    Route::get('/', [TokoController::class, 'index'])->name('toko-index');
    Route::get('/register', [TokoController::class, 'register'])->name('toko-register');
    Route::post('/register', [TokoController::class, 'doRegister'])->name('toko-doRegister');
    Route::get('/profile', [TokoController::class, 'getProfile'])->name('toko-profile');
    Route::prefix('items')->group(function () {
        Route::get('/', [TokoController::class, 'getItems'])->name('toko-items');
        Route::get('/tambah', [TokoController::class, 'getAddItem'])->name('toko-addItem');
        Route::post('/tambah', [TokoController::class, 'doAddItem'])->name('toko-doAddItem');
        Route::get('/hapus/{id}', [TokoController::class, 'doDeleteItem'])->name('toko-doDeleteItem');
    });
});

Route::prefix('admin')->group(function () {
    Route::get('/customer/list', [AdminController::class, 'getCustomerList'])->name('admin-cust-list');
    Route::get('/customer/list/edit/{id?}', [AdminController::class, 'editCustomer'])->name('admin-cust-edit');
    Route::post('/customer/list/edit/{id?}', [AdminController::class, 'doEditCustomer'])->name('admin-cust-doedit');
    Route::get('/toko/list', [AdminController::class, 'getTokoList'])->name('admin-toko-list');
    Route::get('/toko/list/edit/{id?}', [AdminController::class, 'editToko'])->name('admin-toko-edit');
    Route::post('/toko/list/edit/{id?}', [AdminController::class, 'doEditToko'])->name('admin-toko-doedit');
});
