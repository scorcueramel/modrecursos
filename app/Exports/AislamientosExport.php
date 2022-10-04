<?php

namespace App\Exports;

use App\Models\Registro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class AislamientosExport implements FromCollection, WithCustomCsvSettings
{
    public $fi;
    public $ff;

    public function __construct($fi,$ff)
    {
        $this->fi = $fi;
        $this->ff = $ff;
    }

    public function consulta()
    {
        $query = Registro::select('tipo_documento_persona','documento_persona','codigo_pdt','inicial')
        ->join('conceptos', 'registros.concepto_id', '=', 'conceptos.id')
        ->join('dias_personals', 'registros.id', '=', 'dias_personals.id_registro')
        ->whereDate('fecha_inicio', '<=', $this->ff)
        ->whereDate('fecha_fin', '>=', $this->fi)
        ->where('registros.estado', '>', 0)
        ->where('registros.tipo_permiso_id', 4)
        ->get();

        return $query;
    }

    public function collection()
    {
        return $this->consulta();
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => "|",
            'enclosure' => ''
        ];
    }
}
