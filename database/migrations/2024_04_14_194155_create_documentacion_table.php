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
        Schema::create('documentacion', function (Blueprint $table) {
            $table->increments('idDocumentacion');
            $table->string('estatusDocumentacion',50)->requiered();
            $table->string('manualUsuario',20)->requiered();
            $table->string('manualTecnico',20)->requiered();
            $table->string('manualMentenimiento',20)->requiered();
            $table->string('privacidad',20)->requiered();
            $table->string('responsiva',10)->requiered();
            $table->string('documentacionActiva',450)->requiered();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentacion');
    }
};
