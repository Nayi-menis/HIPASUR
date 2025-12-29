<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
        
            // Datos de Identificación
            $table->string('codigo_interno', 50)->unique(); // Ej: EXC-001
            $table->string('tipo', 100); // Excavadora, Volquete, Camioneta
            $table->string('marca', 100);
            $table->string('modelo', 100);
            $table->string('placa', 20)->nullable(); // Algunas máquinas no tienen placa
        
            // Datos Técnicos (Clave en minería)
            $table->decimal('horometro_actual', 10, 2)->default(0); // Horas de uso (ej: 1250.50)
        
            // Estado y Control
            $table->enum('estado', ['OPERATIVO', 'MANTENIMIENTO', 'FUERA_SERVICIO'])->default('OPERATIVO');
            $table->text('observaciones')->nullable();
        
            $table->timestamps(); // create_at y update_at
        });
    }

/**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
