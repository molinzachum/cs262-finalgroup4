<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\OAuthController; 


Route::get('/', function () {
    return view('welcome');
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

    
    // Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');
    
});

require __DIR__.'/auth.php';