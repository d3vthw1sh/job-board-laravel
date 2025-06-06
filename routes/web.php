<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MyJobApplicationController;
use App\Http\Controllers\MyJobController;
use App\Http\Controllers\AdminJobController;
use Illuminate\Support\Facades\Route;

// NEW LANDING PAGE ROUTE
Route::get('welcome', function () {
    return view('landing');
})->name('welcome');

// MAIN JOB BOARD REDIRECT (root /)
Route::get('/', fn() => to_route('welcome'));

// JOB BOARD ROUTES
Route::resource('jobs', JobController::class)
    ->only(['index', 'show']);

// AUTH ROUTES
Route::get('signin', [AuthController::class, 'showSignInForm'])->name('signin');
Route::post('signin', [AuthController::class, 'store'])->name('signin.post');
Route::delete('logout', fn() => to_route('auth.destroy'))->name('logout');
Route::delete('auth', [AuthController::class, 'destroy'])->name('auth.destroy');

// REGISTER ROUTES
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// PROTECTED ROUTES (requires authentication)
Route::middleware('auth')->group(function () {
    Route::resource('job.application', JobApplicationController::class)
        ->only(['create', 'store']);

    Route::resource('my-job-applications', MyJobApplicationController::class)
        ->only(['index', 'destroy']);

    Route::resource('employer', EmployerController::class)
        ->only(['create', 'store']);

    Route::middleware('employer')
        ->resource('my-jobs', MyJobController::class);

    // CV Download
    Route::get('/job-applications/{application}/download-cv', [JobApplicationController::class, 'downloadCV'])
        ->name('job_applications.download_cv');

    // Approve job application for interview (admin/employer only)
    Route::post('/job-applications/{id}/approve', [JobApplicationController::class, 'approveForInterview'])
        ->name('job_applications.approve');
});

// ADMIN PANEL ROUTES (standalone, no inline middleware)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('jobs', [AdminJobController::class, 'index'])->name('jobs.index');
    Route::delete('jobs/{id}', [AdminJobController::class, 'destroy'])->name('jobs.destroy');
});
