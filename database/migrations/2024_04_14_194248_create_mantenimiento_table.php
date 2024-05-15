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
        Schema::create('mantenimiento', function (Blueprint $table) {
            $table->increments('idMantenimiento');
            $table->string('mantenimiento',250)->requiered();
            $table->string('tipoMantenimento',150)->requiered();
            $table->string('descripcionMantenimiento',250)->requiered();
            $table->string('periodos',30)->requiered();
            $table->string('areaResposable',205)->required();
            $table->string('nombreReponsable',50)->requiered();
            $table->string('coordinador',150)->requiered();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimiento');
    }
};
