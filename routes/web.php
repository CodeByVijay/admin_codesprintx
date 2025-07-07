<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

// AuthController Routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('loginPost', [AuthController::class, 'loginPost'])->name('loginPost');


// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Courses Resource Routes (no prefix, so URLs are /courses/...)
    Route::resource('courses', CourseController::class)->names('courses');
});





// Blank pages
Route::get('/table', function () {
    return view('pages/blank/index');
})->name('table');

Route::get('/form', function () {
    return view('pages/blank/form');
})->name('form');
