<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// User Routes
Route::get('/add-user', [DashboardController::class, 'addUser'])->name('addUser');
Route::get('/list-user', [DashboardController::class, 'listUser'])->name('listUser');
Route::get('/appointment', [DashboardController::class, 'showAppointment'])->name('showAppointment');

// Question Bank Routes
Route::get('/add-question', [DashboardController::class, 'addQuestion'])->name('addQuestion');
Route::get('/list-question', [DashboardController::class, 'listQuestion'])->name('listQuestion');

// Exam Routes
Route::get('/add-exam', [DashboardController::class, 'addExam'])->name('addExam');
Route::get('/list-exam', [DashboardController::class, 'listExam'])->name('listExam');

// Valuation Routes
Route::get('/list-mark', [DashboardController::class, 'listMark'])->name('listMark');

// Study Material Routes
Route::get('/add-study-material', [DashboardController::class, 'addStudyMaterial'])->name('addStudyMaterial');
Route::get('/list-study-material', [DashboardController::class, 'listStudyMaterial'])->name('listStudyMaterial');
Route::get('/edit-study-material', [DashboardController::class, 'editStudyMaterial'])->name('editStudyMaterial');
Route::get('/view-study-material', [DashboardController::class, 'viewStudyMaterial'])->name('viewStudyMaterial');
