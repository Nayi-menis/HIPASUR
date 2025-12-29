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
        Schema::create('seguridad_salud', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('tipo_registro'); // Incidente, Inspección EPP, Charla 5 min
            $table->string('area');          // Taller, Mina, Almacén
            $table->string('responsable');   // Quién reporta
            $table->enum('nivel_riesgo', ['BAJO', 'MEDIO', 'ALTO', 'CRÍTICO'])->default('BAJO');
            $table->text('descripcion');     // Detalle de lo ocurrido o hallazgos
            $table->text('accion_correctiva')->nullable(); // Qué se hizo para solucionar
            $table->timestamps();
     });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguridad_salud');
    }
};
