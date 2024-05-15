<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccesoModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'idAccesos';
    protected $table = 'accesos';
    protected $fillable =[
       
        'claveSistema',
        'nombreSistema',
        'descripcion',
        'siglas',
        'clasificacion',
        'desarrollo',
        'estatus',
        'url',
        'idRolSistema',
        'idInformacion',
        'idCaracteriticas',
        'idDocuementacion',
        'idSeguridad',
        'idMantenimiento',
        'idDatos',
        'idAccesos',

    ]; 

    public function usuariosVista()
    {
        return $this->belongsToMany(UsuarioVistaModel::class, 'usuarios_sistemas', 'idAccesos', 'idPersonal');
    }
   
}
