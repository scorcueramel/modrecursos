<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class LicenciasExport implements FromCollection, WithCustomCsvSettings
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
        $feinit = date('Y-m-d',strtotime($this->fi));
        $fefin = date('Y-m-d',strtotime($this->ff));

        $query = DB::select('select r.tipo_documento_persona, r.documento_persona, c.codigo_pdt,
            (case
                when r.fecha_fin < ?
                then 0
                when r.fecha_inicio  > ?
                then 0
                when r.fecha_inicio < ?
                    and r.fecha_fin >= ?
                    and r.fecha_fin <= ?
                    then r.fecha_fin - ? + 1
                when r.fecha_fin > ?
                    and r.fecha_inicio >= ?
                    and r.fecha_inicio <= ?
                    then ? - r.fecha_inicio + 1
                when r.fecha_inicio >= ?
                    and r.fecha_fin <= ?
                    then r.fecha_fin - r.fecha_inicio + 1
                when r.fecha_inicio < ?
                    and r.fecha_fin > ?
                    then cast(? as date) - cast(? as date) + 1
                    else 0 end)
                from registros r
                inner join conceptos c
                    on r.concepto_id = c.id
                inner join dias_personals dp
                    on r.id = dp.id_registro
                where r.estado = true
                and r.tipo_permiso_id = 3',[$feinit, $fefin, $feinit, $feinit, $fefin, $feinit,
                $fefin, $feinit, $fefin, $fefin, $feinit, $fefin, $feinit, $fefin, $fefin, $feinit]);

        return collect($query);
    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => "|",
            'enclosure' => ''
        ];
    }
}
