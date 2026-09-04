<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::post('/login-user', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// User Routes
Route::get('/add-user', [DashboardController::class, 'addUser'])->name('addUser');
Route::get('/list-user', [DashboardController::class, 'listUser'])->name('listUser');
Route::get('/view-user', [DashboardController::class, 'viewUser'])->name('viewUser');
Route::get('/edit-user', [DashboardController::class, 'editUser'])->name('editUser');
Route::post('/update-user', [DashboardController::class, 'updateUser'])->name('updateUser');
Route::post('/delete-user', [DashboardController::class, 'deleteUser'])->name('deleteUser');
Route::get('/appointment', [DashboardController::class, 'showAppointment'])->name('showAppointment');

// Question Bank Routes
Route::get('/add-question', [DashboardController::class, 'addQuestion'])->name('addQuestion');
Route::get('/list-question', [DashboardController::class, 'listQuestion'])->name('listQuestion');

// Exam Routes
Route::get('/list-exam', [DashboardController::class, 'listExam'])->name('listExam');
Route::get('/add-exam', [DashboardController::class, 'addExam'])->name('addExam');
Route::post('/save-exam', [DashboardController::class, 'saveExam'])->name('saveExam');
Route::get('/edit-exam/{id}', [DashboardController::class, 'editExam'])->name('editExam');
Route::post('/update-exam/{id}', [DashboardController::class, 'updateExam'])->name('updateExam');
Route::post('/delete-exam', [DashboardController::class, 'deleteExam'])->name('deleteExam');

// Valuation Routes
Route::get('/list-mark', [DashboardController::class, 'listMark'])->name('listMark');

// Study Material Routes
Route::get('/add-study-material', [DashboardController::class, 'addStudyMaterial'])->name('addStudyMaterial');
Route::get('/list-study-material', [DashboardController::class, 'listStudyMaterial'])->name('listStudyMaterial');
Route::get('/edit-study-material', [DashboardController::class, 'editStudyMaterial'])->name('editStudyMaterial');
Route::get('/view-study-material', [DashboardController::class, 'viewStudyMaterial'])->name('viewStudyMaterial');

// Setting Routes
Route::get('/edit-setting', [DashboardController::class, 'editSetting'])->name('editSetting');

// Notification Routes
Route::get('/list-notification', [DashboardController::class, 'listNotification'])->name('listNotification');
Route::get('/add-notification', [DashboardController::class, 'addNotification'])->name('addNotification');

// User Group Routes
Route::get('/list-user-group', [DashboardController::class, 'listUserGroup'])->name('listUserGroup');
Route::get('/add-user-group', [DashboardController::class, 'addUserGroup'])->name('addUserGroup');
Route::get('/edit-user-group', [DashboardController::class, 'editUserGroup'])->name('editUserGroup');

// Category Routes
Route::get('/list-category', [DashboardController::class, 'listCategory'])->name('listCategory');
Route::post('/save-category', [DashboardController::class, 'saveCategory'])->name('saveCategory');

// Level Routes
Route::get('/list-level', [DashboardController::class, 'listLevel'])->name('listLevel');
Route::post('/save-level', [DashboardController::class, 'saveLevel'])->name('saveLevel');

// Account Type Routes
Route::get('/list-account-type', [DashboardController::class, 'listAccountType'])->name('listAccountType');
Route::get('/add-account-type', [DashboardController::class, 'addAccountType'])->name('addAccountType');
Route::post('/save-account-type', [DashboardController::class, 'saveAccountType'])->name('saveAccountType');
Route::get('/edit-account-type', [DashboardController::class, 'editAccountType'])->name('editAccountType');
Route::get('/update-account-type', [DashboardController::class, 'updateAccountType'])->name('updateAccountType');

// Custom Registration Fields Routes
Route::get('/list-custom-fields', [DashboardController::class, 'listCustomFields'])->name('listCustomFields');
Route::get('/add-custom-fields', [DashboardController::class, 'addCustomFields'])->name('addCustomFields');
Route::post('/save-custom-fields', [DashboardController::class, 'saveCustomFields'])->name('saveCustomFields');
