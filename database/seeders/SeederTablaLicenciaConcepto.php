<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SeederTablaLicenciaConcepto extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $licconcepto  = [
            'LICENCIA CON GOCE DE HABER COMPENSABLE',
            'LICENCIA POR PATERNIDAD',
            'LICENCIA POR ADOPCION',
            'LICENCIA POR FALLECIMIENTO',
            'LICENCIA SIN GOCE DE HABER',
            'LICENCIA SEGÚN LEY N° 1474 Y 1499',
            'LICENCIA SEGÚN LEY N° 30012',
            'LICENCIA POR DESEMPEÑO DE CARGO SINDICAL'
        ];

        foreach($licconcepto as $lc){
            DB::insert('insert into licencia_conceptos (Tipo_Concepto) values (?)', [$lc]);
        }
    }
}
