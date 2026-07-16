<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            
            // 1. Relationships
            $table->foreignId('milestone_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            
            // 2. Core Task Data
            $table->string('title');
            $table->text('desc')->nullable(); // Using 'text' instead of string allows longer descriptions
            
            // 3. Status & Tracking
            $table->string('status')->default('Pending'); // e.g., 'Pending', 'In Progress', 'Completed'
            $table->string('priority')->default('Medium'); // e.g., 'Low', 'Medium', 'High'
            $table->dateTime('due_date')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};