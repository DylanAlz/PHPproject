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
        Schema::create('sale', function (Blueprint $table) {
            $table->integer('sale_id')->primary();
            $table->integer('client_id');
            $table->integer('worker_id')->nullable();
            $table->date('date');
            $table->integer('total_amount');
            
            $table->foreign('client_id')
                  ->references('client_id')
                  ->on('client')
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
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale');
    }
};