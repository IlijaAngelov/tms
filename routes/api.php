<?php

declare(strict_types=1);

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn(Request $request) => $request->user())->middleware('auth:sanctum');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects:index');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects:show');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects:store');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories:index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories:show');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories:store');

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks:index');
Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks:show');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks:store');
Route::patch('/tasks/{id}', [TaskController::class, 'update'])->name('tasks:update');
