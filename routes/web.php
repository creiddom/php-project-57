<?php

use App\Http\Controllers\LabelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('task_statuses', [TaskStatusController::class, 'index'])->name('task_statuses.index');
Route::get('labels', [LabelController::class, 'index'])->name('labels.index');

Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class)->except(['index', 'show']);
    Route::resource('task_statuses', TaskStatusController::class)->except(['index']);
    Route::resource('labels', LabelController::class)->except(['index']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');

require __DIR__ . '/auth.php';
