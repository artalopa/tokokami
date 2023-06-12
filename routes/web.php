<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('index', [
        'title' => 'Tokokami'
    ]);
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard.index', [
            'title' => 'Tokokami - Dashboard'
        ]);
    });

    Route::resource('products', ProductController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'update', 'destroy']);
});
