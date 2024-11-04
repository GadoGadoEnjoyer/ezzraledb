<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sparepartController;
use App\Http\Controllers\movementController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\imageController;

Route::get('/sparepart/upload', [sparepartController::class, 'uploadSparepartForm']);
Route::post('/sparepart/upload', [sparepartController::class, 'uploadSparepart'])->name("uploadSparepart");
Route::get('/sparepart/type/upload', [sparepartController::class, 'uploadTypeForm']);
Route::post('/sparepart/type/upload', [sparepartController::class, 'uploadType'])->name("uploadType");
Route::get('/sparepart/assign/{id}', [sparepartController::class, 'assignTypeForm']);
Route::post('/sparepart/assign/{id}', [sparepartController::class, 'assignType'])->name("assignType");
Route::get('/sparepart/movement/upload', [movementController::class, 'uploadMoveRecordForm']);
Route::post('/sparepart/movement/upload', [movementController::class, 'uploadMoveRecord'])->name("uploadMoveRecord");
Route::get('/sparepart', [sparepartController::class, 'viewSparepart']);
Route::get('/sparepart/{id}', [sparepartController::class, 'viewSparepartDetail']);

Route::get('/admin', [adminController::class, 'adminPage']);
Route::get('/admin/createUser', [adminController::class, 'createUserForm']);
Route::post('/admin/createUser', [adminController::class, 'createUser'])->name("createUser");
Route::get('/admin/updateUser/{id}', [adminController::class, 'updateUserForm'])->name("updateUserForm");
Route::put('/admin/updateUser/{id}', [adminController::class, 'updateUser'])->name("updateUser");
Route::get('/admin/viewUser', [adminController::class, 'viewUser'])->name("viewUser");

Route::get('/image/upload/{id}', [imageController::class, 'uploadImageForm']);
Route::post('/image/upload/{id}', [imageController::class, 'uploadImage'])->name("uploadImage");

Route::get('/login', [adminController::class, 'loginForm']);
Route::post('/login', [adminController::class, 'login'])->name("login");
