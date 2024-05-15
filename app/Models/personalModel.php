<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personalModel extends Model

    {
        protected $primaryKey = 'idPersonal';
        protected $table ='personal';
        protected $fillable = [
            'numeroEmpleado',  
            'nombre',
            'apellidoPaterno',  
            'apellidoMaterno', 
            'area',
            'idAccesos',
        ];
    
        public function accesos()
        {
            return $this->hasMany(AccesosModel::class, 'idAccesos', 'idPersonal');
        }
    }
