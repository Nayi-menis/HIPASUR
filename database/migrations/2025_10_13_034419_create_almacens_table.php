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
        Schema::create('almacens', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->integer('stock');
            $table->integer('stock_minimo'); // Alerta de reabastecimiento
            $table->decimal('precio_unitario', 10, 2)->nullable();
        
            // Categorías: Víveres, Herramientas, Petróleo, EPP, etc.
            $table->string('categoria'); 
        
            $table->string('unidad_medida'); // Kg, Galones, Unidades
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('almacens');
    }
};
