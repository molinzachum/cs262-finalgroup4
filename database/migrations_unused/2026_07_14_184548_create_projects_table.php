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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            
            // 1. Relationships
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            
            // 2. Core Project Data
            $table->string('name');
            $table->text('description')->nullable(); // Using 'text' allows long descriptions without crashing
            
            // 3. Status & Timeline
            $table->string('status')->default('Not Started'); // e.g., 'Not Started', 'In Progress', 'On Hold', 'Completed'
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};