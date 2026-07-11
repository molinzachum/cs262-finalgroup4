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

    $table->foreignId('project_id')
          ->constrained()
          ->onDelete('cascade');

    $table->string('title');
    $table->text('description')->nullable();

    $table->string('status')->default('To-do');

    $table->string('priority')->default('Medium');

    $table->dateTime('due_date')->nullable();

    $table->foreignId('created_by')
          ->constrained('users')
          ->onDelete('cascade');

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
