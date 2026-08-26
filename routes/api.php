<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects:index');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects:show');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects:store');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories:index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories:show');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories:store');