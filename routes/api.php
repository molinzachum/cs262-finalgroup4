<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MilestoneController;

Route::get('/projects/{project}/milestones', [MilestoneController::class, 'index']);