<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionBankController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::post('/login-user', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// User Routes
Route::get('/list-user', [HomeController::class, 'listUser'])->name('listUser');
Route::get('/add-user', [HomeController::class, 'addUser'])->name('addUser');
Route::post('/save-user', [HomeController::class, 'saveUser'])->name('saveUser');
Route::get('/view-user/{id}', [HomeController::class, 'viewUser'])->name('viewUser');
Route::get('/edit-user/{id}', [HomeController::class, 'editUser'])->name('editUser');
Route::post('/update-user/{id}', [HomeController::class, 'updateUser'])->name('updateUser');
Route::delete('/delete-user/{id}', [HomeController::class, 'deleteUser'])->name('deleteUser');

// Appointment Routes
Route::get('/appointment', [HomeController::class, 'showAppointment'])->name('showAppointment');

// Question Bank Routes
Route::get('/list-question', [QuestionBankController::class, 'listQuestion'])->name('listQuestion');
Route::get('/add-question', [QuestionBankController::class, 'addQuestion'])->name('addQuestion');
Route::post('/save-question', [QuestionBankController::class, 'saveQuestion'])->name('saveQuestion');
Route::get('/edit-question-1/{qid}', [QuestionBankController::class, 'editQuestion1'])->name('editQuestion1');
Route::get('/edit-question-2/{qid}', [QuestionBankController::class, 'editQuestion2'])->name('editQuestion2');
Route::get('/edit-question-3/{qid}', [QuestionBankController::class, 'editQuestion3'])->name('editQuestion3');
Route::get('/edit-question-4/{qid}', [QuestionBankController::class, 'editQuestion4'])->name('editQuestion4');
Route::get('/edit-question-5/{qid}', [QuestionBankController::class, 'editQuestion5'])->name('editQuestion5');
Route::post('/update-question-1', [QuestionBankController::class, 'updateQuestion1'])->name('updateQuestion1');
Route::post('/update-question-2', [QuestionBankController::class, 'updateQuestion2'])->name('updateQuestion2');
Route::post('/update-question-3', [QuestionBankController::class, 'updateQuestion3'])->name('updateQuestion3');
Route::post('/update-question-4', [QuestionBankController::class, 'updateQuestion4'])->name('updateQuestion4');
Route::post('/update-question-5', [QuestionBankController::class, 'updateQuestion5'])->name('updateQuestion5');
Route::delete('/delete-question/{id}', [QuestionBankController::class, 'deleteQuestion'])->name('deleteQuestion');
Route::post('/next-question-type', [QuestionBankController::class, 'nextQuestionType'])->name('nextQuestionType');
Route::post('/save-new-question-1', [QuestionBankController::class, 'saveNewQuestion1'])->name('saveNewQuestion1');
Route::post('/save-new-question-2', [QuestionBankController::class, 'saveNewQuestion2'])->name('saveNewQuestion2');
Route::post('/save-new-question-3', [QuestionBankController::class, 'saveNewQuestion3'])->name('saveNewQuestion3');
Route::post('/save-new-question-4', [QuestionBankController::class, 'saveNewQuestion4'])->name('saveNewQuestion4');
Route::post('/save-new-question-5', [QuestionBankController::class, 'saveNewQuestion5'])->name('saveNewQuestion5');

// Exam Routes
Route::get('/list-exam', [HomeController::class, 'listExam'])->name('listExam');
Route::get('/add-exam', [HomeController::class, 'addExam'])->name('addExam');
Route::post('/save-exam', [HomeController::class, 'saveExam'])->name('saveExam');
Route::get('/edit-exam/{id}', [HomeController::class, 'editExam'])->name('editExam');
Route::post('/update-exam/{id}', [HomeController::class, 'updateExam'])->name('updateExam');
Route::delete('/delete-exam/{id}', [HomeController::class, 'deleteExam'])->name('deleteExam');
Route::get('/attempt-exam/{quid}', [HomeController::class, 'attemptExam'])->name('attemptExam');
Route::get('/add-question-into-exam/{quid}', [HomeController::class, 'addQuestionIntoExam'])->name('addQuestionIntoExam');
Route::post('/add-question-into-exam/{quid}/add/{qid}', [HomeController::class, 'addQuestionToExam'])->name('addQuestionToExam');
Route::post('/start-exam', [HomeController::class, 'startExam'])->name('startExam');
Route::get('/start-exam', fn () => redirect()->route('listExam'));
Route::get('/view-result', [HomeController::class, 'viewResult'])->name('viewResult');

// Valuation Routes
Route::get('/list-mark', [HomeController::class, 'listMark'])->name('listMark');

// Study Material Routes
Route::get('/list-study-material', [HomeController::class, 'listStudyMaterial'])->name('listStudyMaterial');
Route::get('/add-study-material', [HomeController::class, 'addStudyMaterial'])->name('addStudyMaterial');
Route::post('/save-study-material', [HomeController::class, 'saveStudyMaterial'])->name('saveStudyMaterial');
Route::get('/edit-study-material/{stid}', [HomeController::class, 'editStudyMaterial'])->name('editStudyMaterial');
Route::post('/update-study-material/{stid}', [HomeController::class, 'updateStudyMaterial'])->name('updateStudyMaterial');
Route::get('/view-study-material/{stid}', [HomeController::class, 'viewStudyMaterial'])->name('viewStudyMaterial');
Route::delete('/delete-study-material/{stid}', [HomeController::class, 'deleteStudyMaterial'])->name('deleteStudyMaterial');

// Setting Routes
Route::get('/edit-setting', [HomeController::class, 'editSetting'])->name('editSetting');

// Notification Routes
Route::get('/list-notification', [HomeController::class, 'listNotification'])->name('listNotification');
Route::get('/add-notification', [HomeController::class, 'addNotification'])->name('addNotification');
Route::post('/save-notification', [HomeController::class, 'saveNotification'])->name('saveNotification');

// User Group Routes
Route::get('/list-user-group', [HomeController::class, 'listUserGroup'])->name('listUserGroup');
Route::get('/add-user-group', [HomeController::class, 'addUserGroup'])->name('addUserGroup');
Route::post('/save-user-group', [HomeController::class, 'saveUserGroup'])->name('saveUserGroup');
Route::get('/edit-user-group/{gid}', [HomeController::class, 'editUserGroup'])->name('editUserGroup');
Route::post('/update-user-group/{gid}', [HomeController::class, 'updateUserGroup'])->name('updateUserGroup');
Route::delete('/delete-user-group/{gid}', [HomeController::class, 'deleteUserGroup'])->name('deleteUserGroup');

// Category Routes
Route::get('/list-category', [HomeController::class, 'listCategory'])->name('listCategory');
Route::post('/save-category', [HomeController::class, 'saveCategory'])->name('saveCategory');
Route::post('/update-category/{cid}', [HomeController::class, 'updateCategory'])->name('updateCategory');
Route::delete('/delete-category/{cid}', [HomeController::class, 'deleteCategory'])->name('deleteCategory');

// Level Routes
Route::get('/list-level', [HomeController::class, 'listLevel'])->name('listLevel');
Route::post('/save-level', [HomeController::class, 'saveLevel'])->name('saveLevel');
Route::post('/update-level/{lid}', [HomeController::class, 'updateLevel'])->name('updateLevel');
Route::delete('/delete-level/{lid}', [HomeController::class, 'deleteLevel'])->name('deleteLevel');

// Account Type Routes
Route::get('/list-account-type', [HomeController::class, 'listAccountType'])->name('listAccountType');
Route::get('/add-account-type', [HomeController::class, 'addAccountType'])->name('addAccountType');
Route::post('/save-account-type', [HomeController::class, 'saveAccountType'])->name('saveAccountType');
Route::get('/edit-account-type/{account_id}', [HomeController::class, 'editAccountType'])->name('editAccountType');
Route::post('/update-account-type/{account_id}', [HomeController::class, 'updateAccountType'])->name('updateAccountType');

// Custom Registration Fields Routes
Route::get('/list-custom-fields', [HomeController::class, 'listCustomFields'])->name('listCustomFields');
Route::get('/add-custom-fields', [HomeController::class, 'addCustomFields'])->name('addCustomFields');
Route::post('/save-custom-fields', [HomeController::class, 'saveCustomFields'])->name('saveCustomFields');
Route::get('/edit-custom-fields/{field_id}', [HomeController::class, 'editCustomFields'])->name('editCustomFields');
Route::post('/update-custom-fields/{field_id}', [HomeController::class, 'updateCustomFields'])->name('updateCustomFields');
Route::post('/delete-custom-fields', [HomeController::class, 'deleteCustomFields'])->name('deleteCustomFields');