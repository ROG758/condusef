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
        Schema::create('datos_personales', function (Blueprint $table) {
            $table->increments('idDatos');
            $table->string('datosPersonales',150)->requiered();
            $table->string('fundamentoLegal',250)->requiered();
            $table->string('tipoDatos',300)->requiered();
            $table->string('obtencionDatos',15)->requiered();
            $table->string('portabilidad',15)->requiered();
            $table->string('trasferencia',50)->requiered();
            $table->string('soporte',15)->requiered();
            $table->string('avisoProvaciada',150)->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_personales');
    }
};
