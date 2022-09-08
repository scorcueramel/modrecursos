<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registro extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['codigo_persona','documento_persona','nombre_persona',
    						'reglab_persona','uniorg_persona','fecha_inicio_persona',
    						'fecha_cese_persona','estado_persona','tipo_permiso_id',
    						'concepto_id','fecha_inicio','fecha_fin','documento',
    						'comentario','usuario_creador','usuario_editor','ip_usuario',
    						'estado'];
}

