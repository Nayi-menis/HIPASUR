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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('almacen_id')->constrained('almacens')->onDelete('cascade');
            // El usuario que está logueado en el sistema y hace la operación
            $table->foreignId('user_id')->constrained('users'); 
            // El trabajador que recibe (puede ser un ID de usuario o un string)
            $table->string('trabajador'); 
            $table->integer('cantidad');
            $table->enum('tipo', ['ENTRADA', 'SALIDA']);
            $table->text('motivo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
