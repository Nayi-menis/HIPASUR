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
        Schema::table('recursos', function (Blueprint $table) {
            $table->string('cargo')->nullable()->after('email');
            $table->unsignedBigInteger('vehiculo_id')->nullable()->after('cargo');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recursos', function (Blueprint $table) {
            //
        });
    }
};
