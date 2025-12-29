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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('estado'); // Ej: EFECTIVO, PENDIENTE
            $table->string('tipo');   // Ej: COMBUSTIBLE, REPUESTOS
            $table->string('descripcion');
            $table->decimal('monto', 10, 2); // El sub monto o base
            $table->decimal('egreso', 10, 2)->default(0);
            $table->decimal('ingreso', 10, 2)->default(0);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
