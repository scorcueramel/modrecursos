<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederTablaDMConceptos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dmconceptos = [
            'DESCANSO MEDICO',
            'SUBSIDIO POR MATERNIDAD',
            'SUBSIDIO POR INCAPACIDAD TEMPORAL',
        ];
        foreach($dmconceptos as $dm){
            DB::insert('insert into descanso_medico_conceptos (Tipo_Concepto) values (?)', [$dm]);
        }
    }
}
