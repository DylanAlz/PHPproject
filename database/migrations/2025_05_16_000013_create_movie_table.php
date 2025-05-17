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
        Schema::create('movie', function (Blueprint $table) {
            $table->integer('movie_id')->primary();
            $table->string('original_name', 25);
            $table->integer('genre_id')->nullable();
            $table->integer('producer_id')->nullable();
            $table->integer('distributor_id')->nullable();
            $table->string('synopsis', 25);
            $table->integer('language_id')->nullable();
            $table->string('offer_name', 25);
            $table->year('premiere_year');
            $table->integer('worker_id')->nullable();
            $table->boolean('active')->default(true);
            
            $table->foreign('genre_id')
                  ->references('genre_id')
                  ->on('genre')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
                  
            $table->foreign('producer_id')
                  ->references('producer_id')
                  ->on('producer')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
                  
            $table->foreign('distributor_id')
                  ->references('distributor_id')
                  ->on('distributor')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
                  
            $table->foreign('language_id')
                  ->references('language_id')
                  ->on('language')
                  ->onDelete('set null')
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
        Schema::dropIfExists('movie');
    }
};