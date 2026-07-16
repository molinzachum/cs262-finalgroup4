<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskAssignmentController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::resource('tasks', TaskController::class);

    Route::view('/teams', 'team.index')->name('team.index');
    Route::view('/projects', 'projects.index')->name('projects.index');
    Route::view('/projects/create', 'projects.create')->name('projects.create');
    Route::view('/projects/show', 'projects.show')->name('projects.show');
    Route::view('/projects/edit', 'projects.edit')->name('projects.edit');
    Route::view('/milestones', 'milestones.index')->name('milestones.index');
    Route::view('/milestones/create', 'milestones.create')->name('milestones.create');
    Route::view('/milestones/edit', 'milestones.edit')->name('milestones.edit');
    Route::view('/timelogs', 'timelogs.index')->name('timelogs.index');
    Route::view('/timelogs/create', 'timelogs.create')->name('timelogs.create');
    Route::view('/timelogs/edit', 'timelogs.edit')->name('timelogs.edit');

    Route::post('/tasks/{task}/assign',
        [TaskAssignmentController::class, 'store']
    );

    Route::delete('/task-assignment/{assignment}',
        [TaskAssignmentController::class, 'destroy']
    );

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
        return "Welcome to the Admin Dashboard! Only Role 1 can see this."; 
        // We will replace this with a real Blade view later
    })->name('dashboard');

    
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');
    
});

require __DIR__.'/auth.php';
