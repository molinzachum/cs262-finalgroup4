<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskAssignmentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectMemberController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\TimeLogController;
use App\Models\Task;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    $tasks = Task::all();
    return view('dashboard', compact('tasks'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Tasks
    |--------------------------------------------------------------------------
    */
    Route::resource('tasks', TaskController::class);

    Route::post('/tasks/{task}/assign', [TaskAssignmentController::class, 'store']);
    Route::delete('/task-assignment/{assignment}', [TaskAssignmentController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | Projects
    |--------------------------------------------------------------------------
    */
    Route::resource('projects', ProjectController::class);

    /*
    |--------------------------------------------------------------------------
    | Teams
    |--------------------------------------------------------------------------
    */
    Route::get('/teams', [ProjectMemberController::class, 'index'])
        ->name('team.index');

    Route::get('/projects/{project}/members', [ProjectMemberController::class, 'index']);
    Route::post('/projects/{project}/members', [ProjectMemberController::class, 'store']);
    Route::patch('/project-members/{member}', [ProjectMemberController::class, 'update']);
    Route::delete('/project-members/{member}', [ProjectMemberController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | Milestones (Frontend Pages)
    |--------------------------------------------------------------------------
    */
    Route::view('/milestones', 'milestones.index')->name('milestones.index');
    Route::view('/milestones/create', 'milestones.create')->name('milestones.create');
    Route::view('/milestones/{id}/edit', 'milestones.edit')->name('milestones.edit');

    /*
    |--------------------------------------------------------------------------
    | Time Logs
    |--------------------------------------------------------------------------
    */
    Route::get('/time-logs', [TimeLogController::class, 'index'])
        ->name('timelogs.index');

    Route::view('/time-logs/create', 'timelogs.create')
        ->name('timelogs.create');

    Route::view('/time-logs/{id}/edit', 'timelogs.edit')
        ->name('timelogs.edit');

    Route::post('/tasks/{task}/time-logs', [TimeLogController::class, 'store'])
        ->name('timelogs.store');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return "Welcome to the Admin Dashboard! Only Role 1 can see this.";
        })->name('dashboard');

        Route::resource('users', UserController::class)
            ->only([
                'index',
                'show',
                'update',
                'destroy',
            ]);
    });

require __DIR__.'/auth.php';