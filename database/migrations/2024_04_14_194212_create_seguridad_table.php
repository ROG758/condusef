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
        Schema::create('seguridad', function (Blueprint $table) {
            $table->increments('idSeguridad');
            $table->string('roles',20)->requiered();
            $table->string('borrado',20)->requiered();
            $table->string('controlAccesos',20)->requiered();
            $table->string('politicas',20)->required();
            $table->string('protocoloSeguridad',15)->requiered();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguridad');
    }
};
