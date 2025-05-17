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
        Schema::create('client', function (Blueprint $table) {
            $table->integer('client_id')->primary();
            $table->string('name', 25);
            $table->integer('type_doc_id')->nullable();
            $table->integer('worker_id')->nullable();
            
            $table->foreign('type_doc_id')
                  ->references('type_doc_id')
                  ->on('document_type')
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
        Schema::dropIfExists('client');
    }
};