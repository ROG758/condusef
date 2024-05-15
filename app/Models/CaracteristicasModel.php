<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaracteristicasModel extends Model
{
    use HasFactory;

    protected $PRIMARYKEY = 'idCaracteriticas';
    protected $table ='caracteristicas';
    protected $fillable =[
            'OS',
            'controlVersion',
            'version',
            'lenguaje',
            'interaccionLenguaje',
            'frameworks',
            'despliegue',
            'servidorweb',
            'manejadorDB',
            'nombreDB',
            'herraminetaDesarrollo',
            'usoAPI'
    ];
}