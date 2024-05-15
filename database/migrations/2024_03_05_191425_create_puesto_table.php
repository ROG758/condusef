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
        Schema::create('puesto', function (Blueprint $table) {
            $table->increments('idPuesto');
            $table->string('puesto',45)->required();
            $table->string('descripcion',150)->required();
            $table->integer('idTipoEmpleado')->unsigned();
            $table->foreign('idTipoEmpleado')->references('idTipoEmpleado')->on('tipoempleado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puesto');
    }
};
