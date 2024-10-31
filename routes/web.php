<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\sparepartController;

Route::get('/sparepart/upload', [sparepartController::class, 'uploadSparepartForm']);
Route::post('/sparepart/upload', [sparepartController::class, 'uploadSparepart'])->name("uploadSparepart");
Route::get('/sparepart/type/upload', [sparepartController::class, 'uploadTypeForm']);
Route::post('/sparepart/type/upload', [sparepartController::class, 'uploadType'])->name("uploadType");
