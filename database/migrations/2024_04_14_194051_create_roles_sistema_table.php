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
        Schema::create('roles_sistema', function (Blueprint $table) {
            $table->increments('idRolSistema');
            $table->string('nombreLiderP',150)->required();
            $table->string('puestoLider',150)->required();
            $table->string('adminProyecto',250)->requiered();
            $table->string('puestoAdmin',150)->requires();
            $table->string('nombreDesarrollador',150)->requiered();
            $table->string('puestoDesarrollador',150)->requiered();
            $table->string('areaUsuaria',250)->required();
            $table->string('puestoUsario',250)->requiered();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_sistema');
    }
};
