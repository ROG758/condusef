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
        Schema::create('tipoempleado', function (Blueprint $table) {
            $table->increments('idTipoEmpleado');
            $table->string('tipoEmpleado',15)->reuired();
            $table->string('descripcion',45)->reuired();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipoempleado');
    }
};
