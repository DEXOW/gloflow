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
        Schema::create('retail_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('group');
            $table->integer('case_config');
            $table->integer('unit_price');
            $table->integer('lower_limit');
            $table->integer('upper_limit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retail_products');
    }
};
