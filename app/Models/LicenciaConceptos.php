<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenciaConceptos extends Model
{
    use HasFactory;

    protected $fillable=[
        'Tipo_Concepto',
        'Estado'
    ];
}
