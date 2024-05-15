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
        Schema::create('personal', function (Blueprint $table) {
        $table->increments('idPersonal');
        $table->integer('idVicepre')->unsigned();
        $table->foreign('idVicepre')->references('idVicepre')->on('vicepresidencia');
        $table->string('numeroEmpleado',6)->unique();  
        $table->string('nombre',30);
        $table->string('apellidoPaterno', 20)->nullable(false); 
        $table->string('apellidoMaterno', 20)->nullable(); 
        $table->string('area',150)->nullable(false);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal');
    }
};
