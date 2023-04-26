<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin.home', [
        'title' => 'Dashboard'
    ]);
});

Route::get('/admin/blog', function () {
    return view('admin.blog', [
        'title' => 'Blog'
    ]);
});
