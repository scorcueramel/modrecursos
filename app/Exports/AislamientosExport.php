<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class AislamientosExport implements FromCollection, WithCustomCsvSettings
{
    public $fi;
    public $ff;

    public function __construct($fi, $ff)
    {
        $this->fi = $fi;
        $this->ff = $ff;
    }

    public function collection()
    {
        $query = DB::table('registros')->selectRaw('registros.fecha_inicio , registros.fecha_fin,(CASE
        when registros.fecha_fin < '.$this->fi.' then 0
        when registros.fecha_inicio  > '.$this->ff.' then 0
        when registros.fecha_inicio < '.$this->fi.'
            and registros.fecha_fin >= '.$this->fi.'
            and registros.fecha_fin <= '.$this->ff.' then registros.fecha_fin - '.$this->fi.' + 1
        when registros.fecha_fin > '.$this->ff.'
            and registros.fecha_inicio >= '.$this->fi.'
            and registros.fecha_inicio <= '.$this->ff.' then '.$this->ff.' - registros.fecha_inicio + 1
        when registros.fecha_inicio >= '.$this->fi.'
            and registros.fecha_fin <= '.$this->ff.' then registros.fecha_fin - registros.fecha_inicio + 1
        when registros.fecha_inicio < '.$this->fi.'
            and registros.fecha_fin > '.$this->ff.' then cast('.$this->ff.' as date) - cast('.$this->fi.' as date) + 1
        else 0 end as dias
        from registros r
        inner join conceptos c
            on registros.concepto_id = c.id
        inner join dias_personals dp
            on registros.id = dp.id_registro
        where registros.estado = true
        and registros.tipo_permiso_id = 4')->get();

        return $query;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => "|",
            'enclosure' => ''
        ];
    }
}
