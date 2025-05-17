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
        Schema::create('client_address', function (Blueprint $table) {
            $table->integer('client_id');
            $table->string('address', 25);
            $table->integer('city_id')->nullable();
            $table->boolean('active')->default(true);
            
            $table->foreign('client_id')
                  ->references('client_id')
                  ->on('client')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->foreign('city_id')
                  ->references('city_id')
                  ->on('city')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
                  
            $table->primary(['client_id', 'address']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_address');
    }
};