<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MantenimientoModel extends Model
{
    use HasFactory;

    protected $PRIMARYkEY = 'idMantenimiento';
    protected $table = 'mantenimiento';
    protected $fillable =[
       
        'mantenimiento',
        'tipoMantenimento',
        'descripcionMantenimiento',
        'periodos',
        'areaResposable',
        'nombreReponsable',
        'coordinador',
    ];
}
