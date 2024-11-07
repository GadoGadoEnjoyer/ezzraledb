<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sparepartController;
use App\Http\Controllers\movementController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\imageController;
use App\Http\Middleware\CheckUser;

Route::get('/sparepart/upload', [sparepartController::class, 'uploadSparepartForm'])->name('uploadSparepartForm');
Route::post('/sparepart/upload', [sparepartController::class, 'uploadSparepart'])->name("uploadSparepart");
Route::get('/sparepart/type/upload', [sparepartController::class, 'uploadTypeForm'])->name('uploadTypeForm');
Route::post('/sparepart/type/upload', [sparepartController::class, 'uploadType'])->name("uploadType");
Route::get('/sparepart/assign/{id}', [sparepartController::class, 'assignTypeForm'])->name('assignTypeForm');
Route::post('/sparepart/assign/{id}', [sparepartController::class, 'assignType'])->name("assignType");
Route::get('/sparepart/movement/upload/{id}', [movementController::class, 'uploadMoveRecordForm'])->name('uploadMoveRecordForm');
Route::post('/sparepart/movement/upload/{id}', [movementController::class, 'uploadMoveRecord'])->name("uploadMoveRecord");
Route::get('/sparepart/movement', [movementController::class, 'viewMoveRecord'])->name("viewMovement");
Route::get('/sparepart', [sparepartController::class, 'viewSparepart'])->name("viewSparepart");
Route::get('/sparepart/{id}', [sparepartController::class, 'viewSparepartDetail'])->name("viewSparepartDetail");
Route::get('/sparepart/edit/{id}', [sparepartController::class, 'editSparepartForm'])->name("editSparepartForm");
Route::put('/sparepart/edit/{id}', [sparepartController::class, 'editSparepart'])->name("editSparepart");


Route::get('/admin', [adminController::class, 'adminPage'])->name('adminPage');
Route::get('/admin/createUser', [adminController::class, 'createUserForm'])->name('createUserForm');
Route::post('/admin/createUser', [adminController::class, 'createUser'])->name("createUser");
Route::get('/admin/updateUser/{id}', [adminController::class, 'updateUserForm'])->name("updateUserForm");
Route::put('/admin/updateUser/{id}', [adminController::class, 'updateUser'])->name("updateUser");
Route::get('/admin/viewUser', [adminController::class, 'viewUser'])->name("viewUser");

Route::get('/image/upload/{id}', [imageController::class, 'uploadImageForm'])->name('uploadImageForm');
Route::post('/image/upload/{id}', [imageController::class, 'uploadImage'])->name("uploadImage");

Route::get('/login', [adminController::class, 'loginForm']);
Route::post('/login', [adminController::class, 'login'])->name("login");
Route::get('/logout', [adminController::class, 'logout'])->name("logout");

Route::get('/search', [sparepartController::class, 'search'])->name('search');

Route::get('/', [AdminController::class, 'main'])->middleware(CheckUser::class.':admin,employee');

