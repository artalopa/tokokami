<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('index', [
        'title' => 'Tokokami'
    ]);
});

Route::get('/admin', function () {
    return view('admin.home', [
        'title' => 'Tokokami - Dashboard'
    ]);
});

Route::get('/admin/produk', [ProdukController::class, 'index']);
Route::post('/admin/produk/store', [ProdukController::class, 'store']);
Route::post('/admin/produk/update', [ProdukController::class, 'update']);
Route::post('/admin/produk/delete', [ProdukController::class, 'delete']);

Route::get('/admin/kategori', [KategoriController::class, 'index']);
Route::post('/admin/kategori/store', [KategoriController::class, 'store']);
Route::post('/admin/kategori/update', [KategoriController::class, 'update']);
Route::post('/admin/kategori/delete', [KategoriController::class, 'delete']);
