<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskAssignmentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectMemberController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Task;
use App\Http\Controllers\TimeLogController;
use App\Http\Controllers\WebMilestoneController;


Route::get('/', function () {
    return view('welcome');
});

// Member Dashboard Route
Route::get('/dashboard', function () {
    $tasks = Task::all();

    return view('dashboard', compact('tasks'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {

    // Task Routes
    Route::resource('tasks', TaskController::class);

    Route::post('/tasks/{task}/assign',
        [TaskAssignmentController::class, 'store']
    );

    Route::delete('/task-assignment/{assignment}',
        [TaskAssignmentController::class, 'destroy']
    );


    // Teams Routes
    Route::get('/teams',
        [ProjectMemberController::class, 'index']
    )->name('team.index');


    // Milestone Routes
    Route::resource('milestones', WebMilestoneController::class);


    // Project routes
    Route::resource('projects', ProjectController::class);


    // Project Member (Teams) Routes
    Route::get('/projects/{project}/members',
        [ProjectMemberController::class, 'index']
    );

    Route::post('/projects/{project}/members',
        [ProjectMemberController::class, 'store']
    );

    Route::patch('/project-members/{member}',
        [ProjectMemberController::class, 'update']
    );

    Route::delete('/project-members/{member}',
        [ProjectMemberController::class, 'destroy']
    );


    // Profile Routes
    Route::get('/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch('/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete('/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');


    // Time Log Routes
    Route::get('/time-logs',
        [TimeLogController::class, 'index']
    )->name('timelogs.index');

    Route::post('/tasks/{task}/time-logs',
        [TimeLogController::class, 'store']
    )->name('timelogs.store');

});


// Admin Routes
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return "Welcome to the Admin Dashboard! Only Role 1 can see this.";
            // We will replace this with a real Blade view later
        })->name('dashboard');


        Route::resource('users', UserController::class)
        ->only([
            'index',
            'show',
            'update',
            'destroy'
        ]);

    });


require __DIR__.'/auth.php';