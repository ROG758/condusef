<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datos_personalesModel extends Model
{
    use HasFactory;

    protected $PRIMARYkEY = 'idDatos';
    protected $table = 'datos_personales';
    protected $fillable =[
       
            'datosPersonales',
            'fundamentoLegal',
            'tipoDatos',
            'obtencionDatos',
            'portabilidad',
            'trasferencia',
            'soporte',
            'avisoProvaciada',

    ]; 
}
