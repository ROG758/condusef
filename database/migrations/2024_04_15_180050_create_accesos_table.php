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
        Schema::create('accesos', function (Blueprint $table) {

            $table->integer('idRolSistema')->unsigned()->nullable();
            $table->foreign('idRolSistema')->references('idRolSistema')->on('roles_sistema');
    
    
            //
            $table->integer('idInformacion')->unsigned()->nullable();
            $table->foreign('idInformacion')->references('idInformacion')->on('informacion');
    
    
            // 
            $table->integer('idCaracteriticas')->unsigned()->nullable();
            $table->foreign('idCaracteriticas')->references('idCaracteriticas')->on('caracteristicas');
    
            //
            $table->integer('idDocumentacion')->unsigned()->nullable();
            $table->foreign('idDocumentacion')->references('idDocumentacion')->on('documentacion');
    
            //
            $table->integer('idSeguridad')->unsigned()->nullable();
            $table->foreign('idSeguridad')->references('idSeguridad')->on('seguridad'); 
    
            //
            $table->integer('idMantenimiento')->unsigned()->nullable();
            $table->foreign('idMantenimiento')->references('idMantenimiento')->on('mantenimiento'); 
    
            //
            $table->integer('idDatos')->unsigned()->nullable();
            $table->foreign('idDatos')->references('idDatos')->on('datos_personales'); 
            
            $table->increments('idAccesos');
            $table->string('claveSistema',50)->required();
            $table->string('nombreSistema',150)->required();
            $table->string('descripcion',1250)->required();
            $table->string('siglas',50)->required();
            $table->string('clasificacion',50)->required();
            $table->string('desarrollo',10)->required();
            $table->string('estatus',50)->required();
            $table->string('url',450)->requiered();
                
       //
       

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accesos');
    }
};