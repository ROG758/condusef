<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformacionModel extends Model
{
    use HasFactory;

    protected $PRIMARYKEY = 'idInformacion';
    protected $table ='informacion';
    protected $fillable =[
        'inicioOperacion',
        'uso',
        'actualizacion',
        'ultimaActualizacion',
        'tipoDatos',
        'tipoPublicacion',
        'interaccion',
        'etapa',
        'subetapa',
        'fase',
        'legado',
        'modelOperacion',
        'interaccionDependencia',
        'interaccionAreas',
        'migracion',
    ];

}
