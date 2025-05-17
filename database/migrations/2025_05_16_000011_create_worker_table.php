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
        Schema::create('worker', function (Blueprint $table) {
            $table->integer('worker_id')->primary();
            $table->string('name', 25);
            $table->date('entry_date')->default(DB::raw('CURRENT_DATE'));
            $table->integer('salary');
            $table->integer('type_doc_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->boolean('active')->default(true);
            
            $table->foreign('type_doc_id')
                  ->references('type_doc_id')
                  ->on('document_type')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
                  
            $table->foreign('role_id')
                  ->references('role_id')
                  ->on('role')
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
        Schema::dropIfExists('worker');
    }
};