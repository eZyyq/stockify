<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockOpnameController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =========================
// HALAMAN UTAMA
// =========================

Route::get('/', function () {
    return view('welcome');
});


// =========================
// DASHBOARD - ADMIN ONLY
// =========================

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('dashboard');


// =========================
// KATEGORI - ADMIN ONLY
// =========================

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
        ->name('categories.edit');

    Route::put('/categories/{category}', [CategoryController::class, 'update'])
        ->name('categories.update');

    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');

});


// =========================
// SUPPLIER - ADMIN ONLY
// =========================

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/suppliers', [SupplierController::class, 'index'])
        ->name('suppliers.index');

    Route::post('/suppliers', [SupplierController::class, 'store'])
        ->name('suppliers.store');

    Route::get('/suppliers/{supplier}/edit', [SupplierController::class, 'edit'])
        ->name('suppliers.edit');

    Route::put('/suppliers/{supplier}', [SupplierController::class, 'update'])
        ->name('suppliers.update');

    Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])
        ->name('suppliers.destroy');

});


// =========================
// USER - ADMIN ONLY
// =========================

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('users.update');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy');

});


// =========================
// REPORT - ADMIN & MANAGER
// =========================

Route::middleware(['auth', 'role:admin,manager'])->group(function () {

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');
    
Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])
    ->name('reports.export.excel');

Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])
    ->name('reports.export.pdf');


});


// =========================
// PRODUK - SEMUA ROLE
// HANYA MELIHAT DATA
// =========================

Route::middleware(['auth', 'role:admin,manager,staff'])->group(function () {

    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

});


// =========================
// PRODUK - ADMIN & MANAGER
// TAMBAH, EDIT, HAPUS
// =========================

Route::middleware(['auth', 'role:admin,manager'])->group(function () {

    Route::post('/products', [ProductController::class, 'store'])
        ->name('products.store');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    Route::put('/products/{product}', [ProductController::class, 'update'])
        ->name('products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->name('products.destroy');

});


// =========================
// TRANSAKSI - SEMUA ROLE
// LIHAT & TAMBAH
// =========================

Route::middleware(['auth', 'role:admin,manager,staff'])->group(function () {

    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('transactions.index');

    Route::post('/transactions', [TransactionController::class, 'store'])
        ->name('transactions.store');

});
Route::middleware(['auth', 'role:admin,manager,staff'])->group(function () {
    Route::get('/stock-opnames', [StockOpnameController::class, 'index'])
        ->name('stock-opnames.index');

    Route::post('/stock-opnames', [StockOpnameController::class, 'store'])
        ->name('stock-opnames.store');
});

// =========================
// TRANSAKSI - ADMIN & MANAGER
// EDIT & HAPUS
// =========================

Route::middleware(['auth', 'role:admin,manager'])->group(function () {

    Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])
        ->name('transactions.edit');

    Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])
        ->name('transactions.update');

    Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])
        ->name('transactions.destroy');

});


// =========================
// PROFILE - USER LOGIN
// =========================

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


// =========================
// AUTHENTICATION - LARAVEL BREEZE
// =========================

require __DIR__.'/auth.php';