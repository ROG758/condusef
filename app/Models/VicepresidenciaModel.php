<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VicepresidenciaModel extends Model
{
    use HasFactory;


    protected $primaryKey = 'idVicepre';
    protected $table ='vicepresidencia';
    protected $fillable =[
            'vicepresidensia'
    ];
}
