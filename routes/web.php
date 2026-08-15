<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Index
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// User Routes
Route::get('/add-user', [DashboardController::class, 'addUser'])->name('addUser');
Route::get('/list-user', [DashboardController::class, 'listUser'])->name('listUser');
Route::get('/appointment', [DashboardController::class, 'showAppointment'])->name('showAppointment');

// Question Bank Routes
Route::get('/add-question', [DashboardController::class, 'addQuestion'])->name('addQuestion');
Route::get('/list-question', [DashboardController::class, 'listQuestion'])->name('listQuestion');
