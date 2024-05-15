<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles_sistemaModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'idRolSistema';
    protected $table ='roles_sistema';
    protected $fillable=[
       'nombreLiderP',
       'puestoLider',
       'adminProyecto',
       'puestoAdmin',
       'nombreDesarrollador',
       'puestoDesarrollador',
       'areaUsuaria',
       'puestoUsario',
    ];
}
