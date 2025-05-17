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
        Schema::create('sale_detail', function (Blueprint $table) {
            $table->integer('detail_id')->primary();
            $table->integer('sale_id');
            $table->integer('seat');
            $table->integer('show_id');
            $table->integer('unit_value');
            $table->integer('amount');
            $table->integer('discount');
            $table->integer('promotion_id')->nullable();
            
            $table->foreign('promotion_id')
                  ->references('promotion_id')
                  ->on('promotion')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
                  
            $table->foreign('sale_id')
                  ->references('sale_id')
                  ->on('sale')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->foreign('show_id')
                  ->references('show_id')
                  ->on('show')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_detail');
    }
};