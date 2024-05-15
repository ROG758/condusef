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
        Schema::create('usuarios_sistemas', function (Blueprint $table) {
            $table->increments('idSistemaPersona');
            
            $table->integer('idPersonal')->unsigned()->required();
            $table->foreign('idPersonal')->references('idPersonal')->on('personal');

            $table->integer('idAccesos')->unsigned()->requiered();
            $table->foreign('idAccesos')->references('idAccesos')->on('accesos');

        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios_sistemas');
    }
};
