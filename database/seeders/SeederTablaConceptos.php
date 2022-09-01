<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conceptos;

class SeederTablaConceptos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Conceptos::create([
            'tipo_permiso_id'=>2,
            'descripcion'=>'DESCANSO MEDICO'
        ]);
        Conceptos::create([
            'tipo_permiso_id'=>2,
            'descripcion'=>'SUBSIDIO POR MATERNIDAD'
        ]);
        Conceptos::create([
            'tipo_permiso_id'=>2,
            'descripcion'=>'SUBSIDIO POR INCAPACIDAD TEMPORAL'
        ]);
        Conceptos::create([
            'tipo_permiso_id'=>3,
            'descripcion'=>'LICENCIA CON GOCE DE HABER COMPENSABLE'
        ]);
        Conceptos::create([
            'tipo_permiso_id'=>3,
            'descripcion'=>'LICENCIA POR PATERNIDAD'
        ]);
        Conceptos::create([
            'tipo_permiso_id'=>3,
            'descripcion'=>'LICENCIA POR ADOPCION'
        ]);
        Conceptos::create([
            'tipo_permiso_id'=>3,
            'descripcion'=>'LICENCIA POR FALLECIMIENTO'
        ]);
        Conceptos::create([
            'tipo_permiso_id'=>3,
            'descripcion'=>'LICENCIA SIN GOCE DE HABER'
        ]);
        Conceptos::create([
            'tipo_permiso_id'=>3,
            'descripcion'=>'LICENCIA SEGÚN LEY N° 1474 Y 1499'
        ]);
        Conceptos::create([
            'tipo_permiso_id'=>3,
            'descripcion'=>'LICENCIA SEGÚN LEY N° 30012'
        ]);
        Conceptos::create([
            'tipo_permiso_id'=>3,
            'descripcion'=>'LICENCIA POR DESEMPEÑO DE CARGO SINDICAL'
        ]);
    }
}
