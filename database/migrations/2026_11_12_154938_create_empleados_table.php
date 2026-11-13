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
        Schema::create('empleados', function (Blueprint $table) {
        $table->id();
        $table->string('identidad', 13)->unique(); 
        $table->string('nombre'); 
        $table->string('apellido'); 
        $table->string('correo')->unique();
        $table->enum('cargo', [
            'Ingeniero Agrónomo', 
            'Asesor Técnico de Campo', 
            'Jefe de Bodega Central', 
            'Operador de Maquinaria', 
            'Cajero'
        ]);
        $table->decimal('salario', 10, 2); 
        $table->date('fecha_ingreso'); 
        $table->enum('estado', ['Activo', 'Inactivo']);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
