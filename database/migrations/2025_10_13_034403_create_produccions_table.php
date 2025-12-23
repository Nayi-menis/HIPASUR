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
        Schema::create('produccions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recurso_id'); // <--- ASEGÚRATE QUE DIGA ESTO
            $table->date('fecha');
            $table->string('zona');
            $table->decimal('cantidad', 10, 2);
            $table->string('tipo_mineral');
            $table->text('observaciones')->nullable();
            $table->foreign('recurso_id')->references('id')->on('recursos');
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produccions');
    }
};
