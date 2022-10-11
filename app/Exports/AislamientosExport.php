<?php

namespace App\Exports;

use App\Models\DiasPersonal;
use App\Models\Registro;
use Carbon\Carbon;
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
        $query = Registro::select('tipo_documento_persona', 'documento_persona', 'codigo_pdt')
            ->join('conceptos', 'registros.concepto_id', '=', 'conceptos.id')
            ->join('dias_personals', 'registros.id', '=', 'dias_personals.id_registro')
            ->whereDate('fecha_inicio', '<=', $this->ff)
            ->whereDate('fecha_fin', '>=', $this->fi)
            ->where('registros.estado', '>', 0)
            ->where('registros.tipo_permiso_id', 4)
            ->get();

        // $q2 = Registro::select('fecha_fin','inicial','saldo','adicional','total')
        // ->join('dias_personals', 'registros.id', '=', 'dias_personals.id_registro')
        // ->where('registros.tipo_permiso_id', 4)
        // ->get();

        // $arreglo = array();
        // foreach($q2 as $key => $value)
        // {
        // //    array_push($arreglo,$q2[$key]);
        //     $fecMax = Carbon::parse($this->ff);
        //     $saldo = Carbon::parse($q2[$key]["fecha_fin"])->diffInDays($fecMax);
        //     array_push($arreglo,$saldo);
        // }

        // dd($arreglo);

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
