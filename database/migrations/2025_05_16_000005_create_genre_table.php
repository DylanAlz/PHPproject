<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Schema::create('genre', function (Blueprint $table) {
            $table->integer('genre_id')->primary();
            $table->string('genre_', 25); // oes, el guion es para diferenciarlo del nombre de la tabla
            $table->string('description', 50);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre');
    }
};