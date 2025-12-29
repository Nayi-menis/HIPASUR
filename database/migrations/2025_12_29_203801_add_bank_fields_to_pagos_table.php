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
        Schema::table('pagos', function (Blueprint $table) {
            // Relaciones para saber a quién se le pagó
            $table->unsignedBigInteger('recurso_id')->nullable()->after('id');
            $table->unsignedBigInteger('proveedor_id')->nullable()->after('recurso_id');

            // Datos del movimiento bancario
            $table->string('nro_operacion', 50)->nullable()->after('monto');
            $table->string('metodo_pago', 50)->nullable()->after('nro_operacion'); // Ej: Transferencia, Efectivo

            // Claves foráneas
            $table->foreign('recurso_id')->references('id')->on('recursos')->onDelete('set null');
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagos', function (Blueprint $table) {
            //
        });
    }
};
