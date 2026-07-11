<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskAssignmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::resource('tasks', TaskController::class);

    Route::post('/tasks/{task}/assign',
        [TaskAssignmentController::class, 'store']
    );

    Route::delete('/task-assignment/{assignment}',
        [TaskAssignmentController::class, 'destroy']
    );

});