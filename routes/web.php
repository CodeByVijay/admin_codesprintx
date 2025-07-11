<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Testimonial\TestimonialController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('auth.login');
});

// AuthController Routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('loginPost', [AuthController::class, 'loginPost'])->name('loginPost');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::get('/profile/remove-picture', [ProfileController::class, 'removeProfilePicture'])->name('profile.remove-picture');

    // Courses Resource Routes (no prefix, so URLs are /courses/...)
    Route::resource('courses', CourseController::class)->names('courses');
    Route::patch('courses/{course}/toggle-status', [CourseController::class, 'toggleStatus'])->name('courses.toggle-status');

    // Testimonials Resource Routes
    Route::resource('testimonials', TestimonialController::class)->names('testimonials');
});





// Blank pages
Route::get('/table', function () {
    return view('pages/blank/index');
})->name('table');

Route::get('/form', function () {
    return view('pages/blank/form');
})->name('form');
