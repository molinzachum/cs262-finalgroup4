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
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change(); // Make password nullable
            $table->string('provider_name')->nullable();       // e.g., 'google', 'github'
            $table->string('provider_id')->nullable();         // Unique ID from the provider
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable(false)->change();
            $table->dropColumn(['provider_name', 'provider_id']);
        });
    }
};