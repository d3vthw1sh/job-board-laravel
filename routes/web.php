<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MyJobApplicationController;
use App\Http\Controllers\MyJobController;
use Illuminate\Support\Facades\Route;

// NEW LANDING PAGE ROUTE
Route::get('welcome', function () {
    return view('landing');
})->name('welcome');

// MAIN JOB BOARD REDIRECT (root /)
Route::get('', fn() => to_route('jobs.index'));

// JOB BOARD ROUTES
Route::resource('jobs', JobController::class)
    ->only(['index', 'show']);

// SIGN IN ROUTE (NEW, replacing 'auth.create')
Route::get('signin', [AuthController::class, 'showSignInForm'])->name('signin');
Route::post('signin', [AuthController::class, 'store'])->name('signin.post');

// AUTH ROUTES (rest)
Route::delete('logout', fn() => to_route('auth.destroy'))->name('logout');
Route::delete('auth', [AuthController::class, 'destroy'])
    ->name('auth.destroy');

// REGISTER ROUTES (NEW)
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
});
