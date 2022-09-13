<?php

namespace App\Exports;

use App\Models\Registro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class VacacionesExport implements FromCollection, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Registro::select('tipo_documento_persona','documento_persona','concepto_id')
        ->where('tipo_permiso_id', 1)->get();
    }

    public function getCsvSettings(): array
{
    return [
        'delimiter' => "|"
    ];
}
}
