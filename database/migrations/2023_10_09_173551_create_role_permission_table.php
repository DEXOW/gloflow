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
        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();
            $table->boolean('manage_products');
            $table->boolean('manage_users');
            $table->boolean('manage_roles');
            $table->boolean('manage_content');
            $table->timestamps();

            $table->foreignId('role_id')->constrained('roles');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permission');
    }
};
