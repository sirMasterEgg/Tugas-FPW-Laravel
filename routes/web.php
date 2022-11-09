<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Models\Store;

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
    Route::get('/register', [CustomerController::class, 'register'])->name('customer-register');
    Route::post('/register', [CustomerController::class, 'doRegister'])->name('customer-doregister');

    Route::get('/profile', [CustomerController::class, 'getProfile'])->name('customer-profile');
    Route::post('/profile', [CustomerController::class, 'doEditProfile'])->name('customer-doEditProfile');

    Route::get('/history', [CustomerController::class, 'getHistory'])->name('customer-history');

    Route::get('/saldo', [CustomerController::class, 'getTopUp'])->name('customer-topup-saldo');
    Route::post('/saldo', [CustomerController::class, 'doTopUp'])->name('customer-dotopup-saldo');

    Route::prefix('/cart')->group(function () {
        Route::post('/add', [CustomerController::class, 'addCart'])->name('customer-add-cart');
        Route::post('/remove', [CustomerController::class, 'removeCart'])->name('customer-remove-cart');
        Route::post('/checkout', [CustomerController::class, 'checkoutCart'])->name('customer-checkout-cart');
        Route::get('/', [CustomerController::class, 'getCart'])->name('customer-cart');
    });

    Route::prefix('favorite')->group(function () {
        Route::get('/', [CustomerController::class, 'getFavorite'])->name('customer-favorite');
        Route::get('/{id}', [CustomerController::class, 'addFavorite'])->name('customer-add-favorite');
    });
    Route::get('/details/{id}', [CustomerController::class, 'getDetails'])->name('customer-details');
    Route::get('/details/{id}/{kode?}', [CustomerController::class, 'getDetailsBarang'])->name('customer-details-barang');
    Route::post('/details/{id}/{kode?}', [CustomerController::class, 'addReview'])->name('customer-add-review-barang');
    Route::get('/{query?}', [CustomerController::class, 'index'])->name('customer-index');
});

Route::prefix('toko')->group(function () {
    Route::get('/', [TokoController::class, 'index'])->name('toko-index');
    Route::get('/register', [TokoController::class, 'register'])->name('toko-register');
    Route::post('/register', [TokoController::class, 'doRegister'])->name('toko-doRegister');
    Route::get('/profile', [TokoController::class, 'getProfile'])->name('toko-profile');

    Route::post('/review/delete', [TokoController::class, 'doDeleteReview'])->name('toko-delete-review');

    Route::get('/post', [TokoController::class, 'getPost'])->name('toko-post');
    Route::post('/post', [TokoController::class, 'doPost'])->name('toko-doPost');
    Route::get('/post/hapus/{id}', [TokoController::class, 'doHapusPost'])->name('toko-doHapusPost');
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
