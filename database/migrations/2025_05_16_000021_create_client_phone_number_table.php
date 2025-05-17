<?php

// Migration for telefono_client table
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
        Schema::create('client_phone_number', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->string('phone_number', 25);
            $table->unsignedBigInteger('phone_type_id')->nullable();
            $table->boolean('active')->default(true);
            
            $table->foreign('client_id')
                  ->references('client_id')
                  ->on('client')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->foreign('phone_type_id')
                  ->references('phone_type_id')
                  ->on('phone_type')
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
        Schema::dropIfExists('client_phone_number');
    }
};