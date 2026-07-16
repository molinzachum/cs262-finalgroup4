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
        Schema::create('milestones', function (Blueprint $table) {
            $table->id(); // PK
            
            // Foreign Key to projects table with cascading delete
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            
            // Core Milestone Data
            $table->string('title');
            $table->text('description')->nullable(); // Upgraded to 'text' and renamed to avoid SQL reserved words
            $table->string('status')->default('Pending'); 
            
            // Dates & Timelines
            $table->dateTime('start_date')->nullable();
            $table->dateTime('due_date')->nullable();
            $table->dateTime('end_date')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milestones');
    }
};