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
            $table->string('codigo_interno')->unique(); // Ej: EXCA-001
            $table->string('tipo');            // Camioneta, Excavadora, etc.
            $table->string('placa')->nullable();
            $table->string('marca');
            $table->string('modelo');
            $table->string('serie_motor')->nullable();
            $table->string('estado')->default('OPERATIVO'); // OPERATIVO, TALLER
            $table->timestamps();
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
