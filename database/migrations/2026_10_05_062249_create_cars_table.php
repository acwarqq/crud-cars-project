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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand', 50);
            $table->string('model', 50);
            $table->unsignedInteger('price');
            $table->unsignedSmallInteger('release_year');
            $table->unsignedTinyInteger('release_month');
            $table->decimal('engine_displacement', 3, 1)->nullable();
            $table->boolean('is_available')->default(true);
            $table->foreignId('body_type_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
