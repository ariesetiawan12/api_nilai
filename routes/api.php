<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NilaiController;

Route::get('/nilai', [NilaiController::class, 'index']);
Route::get('/nilai/{id}', [NilaiController::class, 'show']);
Route::post('/nilai', [NilaiController::class, 'store']);