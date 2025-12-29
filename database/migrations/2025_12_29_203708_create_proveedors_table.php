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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('ruc', 20)->unique();
            $table->string('razon_social', 150);
            $table->string('banco', 50); // Ej: BCP, BBVA, Interbank
            $table->string('nro_cuenta', 30);
            $table->string('tipo_cuenta', 50); // Ej: Corriente, Ahorros, CCI
            $table->string('contacto_nombre')->nullable();
            $table->string('celular', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};
