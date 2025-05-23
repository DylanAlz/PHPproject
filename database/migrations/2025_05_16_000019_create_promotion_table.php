
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
        Schema::create('promotion', function (Blueprint $table) {
            $table->integer('promotion_id')->primary();
            $table->string('description', 50);
            $table->integer('card_id');
            $table->integer('discount');
            $table->integer('worker_id')->nullable();
            $table->boolean('active')->default(true);
            
            $table->foreign('card_id')
                  ->references('card_id')
                  ->on('card')
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
        Schema::dropIfExists('promotion');
    }
};