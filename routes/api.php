<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects:index');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects:show');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects:store');