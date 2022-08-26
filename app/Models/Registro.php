<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $fillable = ['codigo_persona','tipo_permiso_id','concepto_id','fecha_inicio','fecha_fin','documento','comentario','usuario_creador','usuario_editor','ip_usuario','estado'];
}
