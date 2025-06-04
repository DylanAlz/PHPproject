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
        Schema::create('employee', function (Blueprint $table) {
            $table->id('Empleado_ID');
            $table->string('nombre');
            $table->date('fecha_ingreso')->nullable();
            $table->decimal('salario', 10, 2);
            $table->unsignedBigInteger('tipo_doc_id')->nullable();
            $table->unsignedBigInteger('cargo_id')->nullable();
            $table->unsignedBigInteger('jefe_id')->nullable();
            $table->boolean('activo')->default(true);
            $table->boolean('bit_usuario')->default(false);

            $table->foreign('Tipo_Doc_ID')->references('id')->on('document_type')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('Cargo_ID')->references('id')->on('roles')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('Jefe_ID')->references('Empleado_ID')->on('employee')->onDelete('set null')->onUpdate('cascade');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
