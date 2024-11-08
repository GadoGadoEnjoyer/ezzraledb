<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sparepartController;
use App\Http\Controllers\movementController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\imageController;
use App\Http\Middleware\CheckUser;

Route::get('/sparepart/upload', [sparepartController::class, 'uploadSparepartForm'])->middleware(CheckUser::class.':admin')->name('uploadSparepartForm');
Route::post('/sparepart/upload', [sparepartController::class, 'uploadSparepart'])->middleware(CheckUser::class.':admin')->name("uploadSparepart");
Route::get('/sparepart/movement/upload/{id}', [movementController::class, 'uploadMoveRecordForm'])->middleware(CheckUser::class.':admin,employee')->name('uploadMoveRecordForm');
Route::post('/sparepart/movement/upload/{id}', [movementController::class, 'uploadMoveRecord'])->middleware(CheckUser::class.':admin,employee')->name("uploadMoveRecord");
Route::get('/sparepart/movement', [movementController::class, 'viewMoveRecord'])->middleware(CheckUser::class.':admin,employee')->name("viewMovement");
Route::get('/sparepart', [sparepartController::class, 'viewSparepart'])->middleware(CheckUser::class.':admin,employee')->name("viewSparepart");
Route::get('/sparepart/{id}', [sparepartController::class, 'viewSparepartDetail'])->middleware(CheckUser::class.':admin,employee')->name("viewSparepartDetail");
Route::get('/sparepart/edit/{id}', [sparepartController::class, 'editSparepartForm'])->middleware(CheckUser::class.':admin')->name("editSparepartForm");
Route::put('/sparepart/edit/{id}', [sparepartController::class, 'editSparepart'])->middleware(CheckUser::class.':admin')->name("editSparepart");


Route::get('/admin', [adminController::class, 'adminPage'])->middleware(CheckUser::class.':admin')->name('adminPage');
Route::get('/admin/createUser', [adminController::class, 'createUserForm'])->middleware(CheckUser::class.':admin')->name('createUserForm');
Route::post('/admin/createUser', [adminController::class, 'createUser'])->middleware(CheckUser::class.':admin')->name("createUser");
Route::get('/admin/updateUser/{id}', [adminController::class, 'updateUserForm'])->middleware(CheckUser::class.':admin')->name("updateUserForm");
Route::put('/admin/updateUser/{id}', [adminController::class, 'updateUser'])->middleware(CheckUser::class.':admin')->name("updateUser");
Route::get('/admin/viewUser', [adminController::class, 'viewUser'])->middleware(CheckUser::class.':admin')->name("viewUser");

Route::get('/image/upload/{id}', [imageController::class, 'uploadImageForm'])->middleware(CheckUser::class.':admin,employee')->name('uploadImageForm');
Route::post('/image/upload/{id}', [imageController::class, 'uploadImage'])->middleware(CheckUser::class.':admin,employee')->name("uploadImage");

Route::get('/login', [adminController::class, 'loginForm'])->name("loginForm");
Route::post('/login', [adminController::class, 'login'])->name("login");
Route::get('/logout', [adminController::class, 'logout'])->name("logout");

Route::get('/search', [sparepartController::class, 'search'])->name('search');

Route::get('/', [AdminController::class, 'main'])->middleware(CheckUser::class.':admin,employee')->name('main');

