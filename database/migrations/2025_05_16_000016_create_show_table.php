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
        Schema::create('show', function (Blueprint $table) {
            $table->integer('show_id')->primary();
            $table->integer('room_id');
            $table->integer('movie_id');
            $table->date('date');
            $table->time('time');
            $table->integer('price');
            $table->integer('worker_id')->nullable();
            $table->boolean('active')->default(true);
            
            $table->foreign('room_id')
                  ->references('room_id')
                  ->on('room')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->foreign('movie_id')
                  ->references('movie_id')
                  ->on('movie')
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
        Schema::dropIfExists('show');
    }
};