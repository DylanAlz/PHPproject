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
        Schema::create('city', function (Blueprint $table) {
            $table->integer('city_id')->primary();
            $table->string('name', 25);
            $table->integer('department_id');
            $table->foreign('department_id')
                  ->references('department_id')
                  ->on('department')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('city');
    }
};