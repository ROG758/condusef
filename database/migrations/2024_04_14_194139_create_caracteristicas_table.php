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
        Schema::create('caracteristicas', function (Blueprint $table) {
            $table->increments('idCaracteriticas');
            $table->string('OS',50)->requiered();
            $table->string('controlVersion',50)->requiered();
            $table->string('version',50)->required();
            $table->string('lenguaje',15)->requiered();
            $table->string('interaccionLenguaje',50)->required();
            $table->string('frameworks',30)->required();
            $table->string('despliegue',50)->required();
            $table->string('servidorweb',150)->requiered();
            $table->string('manejadorDB',15)->required();
            $table->string('nombreDB',50)->requiered();
            $table->string('herraminetaDesarrollo',50)->requiered();
            $table->string('usoAPI',20)->requiered();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caracteristicas');
    }
};
