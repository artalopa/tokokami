<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('index', [
        'title' => 'Tokokami'
    ]);
});

// Route::get('/admin', function () {
//     return view('admin.dashboard.index', [
//         'title' => 'Tokokami - Dashboard'
//     ]);
// });

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard.index', [
            'title' => 'Tokokami - Dashboard'
        ]);
    });

    Route::resource('products', ProductController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'update', 'destroy']);
});

// Route::get('/admin/produk', [ProductController::class, 'index']);
// Route::post('/admin/produk/store', [ProductController::class, 'store']);
// Route::post('/admin/produk/update', [ProductController::class, 'update']);
// Route::post('/admin/produk/delete', [ProductController::class, 'delete']);

// Route::get('/admin/kategori', [CategoryController::class, 'index']);
// Route::post('/admin/kategori/store', [CategoryController::class, 'store']);
// Route::post('/admin/kategori/update', [CategoryController::class, 'update']);
// Route::post('/admin/kategori/delete', [CategoryController::class, 'delete']);
