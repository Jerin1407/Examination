<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuestionBankController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::post('/login-user', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// User Routes
Route::get('/list-user', [DashboardController::class, 'listUser'])->name('listUser');
Route::get('/add-user', [DashboardController::class, 'addUser'])->name('addUser');
Route::post('/save-user', [DashboardController::class, 'saveUser'])->name('saveUser');
Route::get('/view-user/{id}', [DashboardController::class, 'viewUser'])->name('viewUser');
Route::get('/edit-user/{id}', [DashboardController::class, 'editUser'])->name('editUser');
Route::post('/update-user/{id}', [DashboardController::class, 'updateUser'])->name('updateUser');
Route::delete('/delete-user/{id}', [DashboardController::class, 'deleteUser'])->name('deleteUser');

// Appointment Routes
Route::get('/appointment', [DashboardController::class, 'showAppointment'])->name('showAppointment');

// Question Bank Routes
Route::get('/list-question', [QuestionBankController::class, 'listQuestion'])->name('listQuestion');
Route::get('/add-question', [QuestionBankController::class, 'addQuestion'])->name('addQuestion');
Route::post('/save-question', [QuestionBankController::class, 'saveQuestion'])->name('saveQuestion');
Route::get('/edit-question-1', [QuestionBankController::class, 'editQuestion1'])->name('editQuestion1');
Route::get('/edit-question-2', [QuestionBankController::class, 'editQuestion2'])->name('editQuestion2');
Route::get('/edit-question-3', [QuestionBankController::class, 'editQuestion3'])->name('editQuestion3');
Route::get('/edit-question-4', [QuestionBankController::class, 'editQuestion4'])->name('editQuestion4');
Route::get('/edit-question-5', [QuestionBankController::class, 'editQuestion5'])->name('editQuestion5');
Route::post('/update-question', [QuestionBankController::class, 'updateQuestion'])->name('updateQuestion');
Route::delete('/delete-question/{id}', [QuestionBankController::class, 'deleteQuestion'])->name('deleteQuestion');
Route::post('/next-question-type', [QuestionBankController::class, 'nextQuestionType'])->name('nextQuestionType');
Route::post('/save-new-question-1', [QuestionBankController::class, 'saveNewQuestion1'])->name('saveNewQuestion1');
Route::post('/save-new-question-2', [QuestionBankController::class, 'saveNewQuestion2'])->name('saveNewQuestion2');
Route::post('/save-new-question-3', [QuestionBankController::class, 'saveNewQuestion3'])->name('saveNewQuestion3');
Route::post('/save-new-question-4', [QuestionBankController::class, 'saveNewQuestion4'])->name('saveNewQuestion4');
Route::post('/save-new-question-5', [QuestionBankController::class, 'saveNewQuestion5'])->name('saveNewQuestion5');

// Exam Routes
Route::get('/list-exam', [DashboardController::class, 'listExam'])->name('listExam');
Route::get('/add-exam', [DashboardController::class, 'addExam'])->name('addExam');
Route::post('/save-exam', [DashboardController::class, 'saveExam'])->name('saveExam');
Route::get('/edit-exam/{id}', [DashboardController::class, 'editExam'])->name('editExam');
Route::post('/update-exam/{id}', [DashboardController::class, 'updateExam'])->name('updateExam');
Route::delete('/delete-exam/{id}', [DashboardController::class, 'deleteExam'])->name('deleteExam');
Route::get('/attempt-exam', [DashboardController::class, 'attemptExam'])->name('attemptExam');

// Valuation Routes
Route::get('/list-mark', [DashboardController::class, 'listMark'])->name('listMark');

// Study Material Routes
Route::get('/list-study-material', [DashboardController::class, 'listStudyMaterial'])->name('listStudyMaterial');
Route::get('/add-study-material', [DashboardController::class, 'addStudyMaterial'])->name('addStudyMaterial');
Route::post('/save-study-material', [DashboardController::class, 'saveStudyMaterial'])->name('saveStudyMaterial');
Route::get('/edit-study-material/{stid}', [DashboardController::class, 'editStudyMaterial'])->name('editStudyMaterial');
Route::post('/update-study-material/{stid}', [DashboardController::class, 'updateStudyMaterial'])->name('updateStudyMaterial');
Route::get('/view-study-material/{stid}', [DashboardController::class, 'viewStudyMaterial'])->name('viewStudyMaterial');
Route::delete('/delete-study-material/{stid}', [DashboardController::class, 'deleteStudyMaterial'])->name('deleteStudyMaterial');

// Setting Routes
Route::get('/edit-setting', [DashboardController::class, 'editSetting'])->name('editSetting');

// Notification Routes
Route::get('/list-notification', [DashboardController::class, 'listNotification'])->name('listNotification');
Route::get('/add-notification', [DashboardController::class, 'addNotification'])->name('addNotification');
Route::post('/save-notification', [DashboardController::class, 'saveNotification'])->name('saveNotification');

// User Group Routes
Route::get('/list-user-group', [DashboardController::class, 'listUserGroup'])->name('listUserGroup');
Route::get('/add-user-group', [DashboardController::class, 'addUserGroup'])->name('addUserGroup');
Route::post('/save-user-group', [DashboardController::class, 'saveUserGroup'])->name('saveUserGroup');
Route::get('/edit-user-group/{gid}', [DashboardController::class, 'editUserGroup'])->name('editUserGroup');
Route::post('/update-user-group/{gid}', [DashboardController::class, 'updateUserGroup'])->name('updateUserGroup');
Route::post('/delete-user-group', [DashboardController::class, 'deleteUserGroup'])->name('deleteUserGroup');

// Category Routes
Route::get('/list-category', [DashboardController::class, 'listCategory'])->name('listCategory');
Route::post('/save-category', [DashboardController::class, 'saveCategory'])->name('saveCategory');
Route::post('/update-category/{cid}', [DashboardController::class, 'updateCategory'])->name('updateCategory');
Route::post('/delete-category', [DashboardController::class, 'deleteCategory'])->name('deleteCategory');

// Level Routes
Route::get('/list-level', [DashboardController::class, 'listLevel'])->name('listLevel');
Route::post('/save-level', [DashboardController::class, 'saveLevel'])->name('saveLevel');
Route::post('/update-level/{lid}', [DashboardController::class, 'updateLevel'])->name('updateLevel');
Route::post('/delete-level', [DashboardController::class, 'deleteLevel'])->name('deleteLevel');

// Account Type Routes
Route::get('/list-account-type', [DashboardController::class, 'listAccountType'])->name('listAccountType');
Route::get('/add-account-type', [DashboardController::class, 'addAccountType'])->name('addAccountType');
Route::post('/save-account-type', [DashboardController::class, 'saveAccountType'])->name('saveAccountType');
Route::get('/edit-account-type/{account_id}', [DashboardController::class, 'editAccountType'])->name('editAccountType');
Route::post('/update-account-type/{account_id}', [DashboardController::class, 'updateAccountType'])->name('updateAccountType');

// Custom Registration Fields Routes
Route::get('/list-custom-fields', [DashboardController::class, 'listCustomFields'])->name('listCustomFields');
Route::get('/add-custom-fields', [DashboardController::class, 'addCustomFields'])->name('addCustomFields');
Route::post('/save-custom-fields', [DashboardController::class, 'saveCustomFields'])->name('saveCustomFields');
Route::get('/edit-custom-fields/{field_id}', [DashboardController::class, 'editCustomFields'])->name('editCustomFields');
Route::post('/update-custom-fields/{field_id}', [DashboardController::class, 'updateCustomFields'])->name('updateCustomFields');
Route::post('/delete-custom-fields', [DashboardController::class, 'deleteCustomFields'])->name('deleteCustomFields');