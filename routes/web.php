<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskAssignmentController;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::resource('tasks', TaskController::class);

    Route::view('/teams', 'team.index')->name('team.index');
    Route::view('/time-logs', 'timelogs.index')->name('timelogs.index');

    Route::view('/teams', 'team.index')->name('team.index');
    Route::view('/time-logs', 'timelogs.index')->name('timelogs.index');

    Route::post(
        '/tasks/{task}/assign',
        [TaskAssignmentController::class, 'store']
    );

    Route::delete(
        '/task-assignment/{assignment}',
        [TaskAssignmentController::class, 'destroy']
    );

    // Project routes
    Route::get(
        '/projects/{project}',
        [ProjectController::class, 'show']
    );

    Route::resource('projects', ProjectController::class);
});


// member dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes 
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
        // We will replace this with a real Blade view later
    })->name('dashboard');


    // Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');

});

Route::middleware('auth')->group(function () {

    Route::resource('tasks', TaskController::class);

    Route::post(
        '/tasks/{task}/assign',
        [TaskAssignmentController::class, 'store']
    );

    Route::delete(
        '/task-assignment/{assignment}',
        [TaskAssignmentController::class, 'destroy']
    );

    Route::get(
        '/projects/{project}',
        [ProjectController::class, 'show']
    );
});

require __DIR__ . '/auth.php';
