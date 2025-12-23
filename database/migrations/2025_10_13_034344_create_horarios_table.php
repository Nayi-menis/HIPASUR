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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();
        
            // Vínculo con el trabajador (Recursos Humanos)
            $table->unsignedBigInteger('recurso_id');
            $table->foreign('recurso_id')->references('id')->on('recursos')->onDelete('cascade');

            $table->date('fecha');
            $table->time('hora_entrada');
            $table->time('hora_salida')->nullable(); // Se llena al marcar salida
            $table->string('turno', 50); // Ej: Mañana, Tarde, Noche o Guardia A
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
