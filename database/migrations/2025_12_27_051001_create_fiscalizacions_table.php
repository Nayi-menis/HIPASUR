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
        Schema::create('fiscalizaciones', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('entidad');       // Ejemplo: SUNAFIL, Municipalidad, Auditoría Interna
            $table->string('inspector');     // Nombre del fiscalizador
            $table->string('motivo');        // Ejemplo: Seguridad, Ambiental, Tributario
            $table->enum('resultado', ['APROBADO', 'CON OBSERVACIONES', 'MULTA/SANCIÓN'])->default('APROBADO');
            $table->text('observaciones')->nullable();
            $table->text('medidas_adoptadas')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiscalizacions');
    }
};
