<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conceptos extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'descripcion',
        'codigo_pdt',
        'estado'
    ];
}
