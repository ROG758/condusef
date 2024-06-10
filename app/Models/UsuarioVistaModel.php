<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\accesoModel;
use App\Http\Models\personalModel;


class UsuarioVistaModel extends Model
{
    use HasFactory;


    protected $primaryKey = 'idSistemaPersona';
    protected $table = 'usuarios_sistemas';
    protected $fillable =[
       
        'idPersonal',
        'idAccesos',
        'estatus',
        

    ]; 

    public function acceso()
    {
        return $this->belongsTo(AccesoModel::class, 'idAccesos', 'id');
    }

    public function personal()
    {
        return $this->belongsTo(personalModel::class, 'idPersonal', 'id');
    }

}
