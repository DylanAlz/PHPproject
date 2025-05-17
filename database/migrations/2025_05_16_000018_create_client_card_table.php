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
        Schema::create('client_card', function (Blueprint $table) {
            $table->integer('card_number')->primary();
            $table->year('year');
            $table->integer('worker_id')->nullable();
            $table->integer('client_id');
            $table->integer('card_id');
            $table->boolean('active')->default(true);
            
            $table->foreign('worker_id')
                  ->references('worker_id')
                  ->on('worker')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
                  
            $table->foreign('client_id')
                  ->references('client_id')
                  ->on('client')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->foreign('card_id')
                  ->references('card_id')
                  ->on('card')
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
        Schema::dropIfExists('client_card');
    }
};