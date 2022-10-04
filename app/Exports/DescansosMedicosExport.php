<?php

namespace App\Exports;

use App\Models\DiasPersonal;
use App\Models\Registro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class DescansosMedicosExport implements FromCollection, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Registro::select('tipo_documento_persona','documento_persona','codigo_pdt','inicial')
        ->join('conceptos', 'registros.concepto_id', '=', 'conceptos.id')
        ->join('dias_personals', 'registros.id', '=', 'dias_personals.id_registro')
        ->where('registros.tipo_permiso_id', 2)->get();
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => "|",
            'enclosure' => ''
        ];
    }
}
