<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('edad', 100);
            $table->string('DNI', 20)->unique();
            $table->string('celular', 100);
            $table->string('fecha_nacimiento', 100);
            $table->string('cuenta', 30)->unique();
            $table->string('stc', 30)->unique();
            $table->string('departamento', 100);
            $table->string('provincia', 100);
            $table->string('cargo', 50);
            $table->string('vehiculo_id', 50);
            $table->string('email')->unique();

            // Relación con tabla users
            $table->unsignedBigInteger('user_id')->nullable()->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recursos');
    }
};

