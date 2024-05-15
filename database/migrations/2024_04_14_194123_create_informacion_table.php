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
        Schema::create('informacion', function (Blueprint $table) {
            $table->increments('idInformacion');
            $table->string('inicioOperacion');
            $table->string('uso',50)->required();
            $table->string('actualizacion',20)->requiered();
            $table->string('ultimaActualizacion');
            $table->string('tipoDatos',50)->required();
            $table->string('tipoPublicacion',20)->required();
            $table->string('interaccion',50)->requiered();
            $table->string('etapa',10)->required();
            $table->string('subetapa',50)->required();
            $table->string('fase',10)->requiered();
            $table->string('legado',20)->required();
            $table->string('modelOperacion',50)->requiered();
            $table->string('interaccionDependencia',150)->required();
            $table->string('interaccionAreas',150)->requiered();
            $table->string('migracion',50)->requiered();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informacion');
    }
};
