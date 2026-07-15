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
        $table->foreignId('project_id')->constrained()->onDelete('cascade'); // FK to projects
        $table->string('title');
        $table->string('desc')->nullable();
        $table->string('status')->default('Pending');
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
