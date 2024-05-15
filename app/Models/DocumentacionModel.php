<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentacionModel extends Model
{
    use HasFactory;

    protected $PRIMARYKEY = 'idDocumentacion';
    protected $table ='documentacion';
    protected $fillable =[
            'estatusDocumentacion',
            'manualUsuario',
            'manualTecnico',
            'manualMentenimiento',
            'privacidad',
            'responsiva',
            'documentacionActiva',
    ];

}
