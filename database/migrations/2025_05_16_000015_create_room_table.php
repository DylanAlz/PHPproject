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
        Schema::create('room', function (Blueprint $table) {
            $table->integer('room_id')->primary();
            $table->integer('capacity');
            $table->integer('room_number');
            $table->integer('theater_id');
            $table->integer('worker_id')->nullable();
            $table->boolean('active')->default(true);
            
            $table->foreign('theater_id')
                  ->references('theater_id')
                  ->on('theater')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->foreign('worker_id')
                  ->references('worker_id')
                  ->on('worker')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
                  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('room');
    }
};