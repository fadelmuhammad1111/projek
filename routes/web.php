<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('home');
});


// Login routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register', [LoginController::class, 'register'])->name('register');

// Dashboard home
Route::get('/index', [LoginController::class, 'index'])->name('landing');

// Akun management
Route::prefix('/akun')->name('akun.')->group(function () {
    Route::get('/index', [ReportsController::class, 'index'])->name('index');
    Route::get('/create', [LoginController::class, 'create'])->name('create');
    Route::post('/store',  [ReportsController::class, 'store'])->name('store');
    Route::get('/monitoring',  [ReportsController::class, 'monitoring'])->name('monitoring');
    Route::delete('/delete/{id}',  [ReportsController::class, 'destroy'])->name('destroy');
    Route::post('/reports/{id}/like', [ReportsController::class, 'incrementLikes'])->name('reports.like');
    Route::post('/reports/{id}/view', [ReportController::class, 'updateViewCount'])->name('reports.view');

});

Route::prefix('/detail')->name('detail.')->group(function (){
Route::get('/reports/{id}', [ReportsController::class, 'show'])->name('show');
Route::post('/comments', [ReportsController::class, 'storeComment'])->name('store');

});

// Location routes for cascading dropdown
Route::get('/api/provinces', [LocationController::class, 'getProvinces'])->name('provinsi');
Route::get('/api/regencies/{provinceId}', [LocationController::class, 'getRegencies']);
Route::get('/api/districts/{regencyId}', [LocationController::class, 'getDistricts']);
Route::get('/api/villages/{districtId}', [LocationController::class, 'getVillages']);