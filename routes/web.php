<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin/blog', function () {
    return view('admin.blog', [
        'title' => 'Tokokami - Blog'
    ]);
});
