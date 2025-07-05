<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

// AuthController Routes
Route::get('login',[AuthController::class,'login'])->name('login');
Route::post('loginPost',[AuthController::class,'loginPost'])->name('loginPost');


// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});





// Blank pages
Route::get('/table', function () {
    return view('backend/blank/index');
})->name('table');

Route::get('/form', function () {
    return view('backend/blank/form');
})->name('form');
