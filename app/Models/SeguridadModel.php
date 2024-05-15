<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeguridadModel extends Model
{
    use HasFactory;

    protected $PRIMARYkEY = 'idSeguridad';
    protected $table = 'seguridad';
    protected $fillable =[
        'roles',
        'borrado',
        'controlAccesos',
        'politicas',
        'protocoloSeguridad',
    ];
}
