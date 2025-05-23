
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
        Schema::create('theater', function (Blueprint $table) {
            $table->integer('theater_id')->primary();
            $table->string('address', 25);
            $table->string('name', 25);
            $table->integer('city_id');
            $table->string('phone_number', 25);
            $table->integer('worker_id')->nullable();
            $table->boolean('active')->default(true);
            
            $table->foreign('city_id')
                  ->references('city_id')
                  ->on('city')
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
        Schema::dropIfExists('theater');
    }
};