<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

// الصفحة الرئيسية (عرض المقالات)
Route::get('/', [PostController::class, 'index']);

// مسارات إدارة المقالات (محمية بجلسة مستخدم مسجل)
Route::resource('posts', PostController::class)->middleware('auth');

// مسارات المصادقة (تسجيل الدخول والتسجيل)
Auth::routes();

// تعديل مسار الصفحة بعد تسجيل الدخول ليكون /posts بدلاً من /home
Route::get('/home', function () {
    return redirect('/posts');
})->name('home');

// تسجيل الخروج
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
