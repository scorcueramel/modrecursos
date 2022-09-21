<?php

namespace App\Imports;

use App\Models\DiasPersonal;
use App\Models\Registro;
use App\Models\ResponseDTO;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RegistrosImport implements ToModel, WithStartRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $codigo = $row[0];
        $fi = $row[11];
        $ff = $row[12];

        $query = DB::table('registros')
        ->where('codigo_persona', '=', $codigo)
        ->whereDate('fecha_inicio', '<=', $ff)
        ->whereDate('fecha_fin', '>=', $fi)
        ->where('deleted_at', '=', null)
        ->get();

        if (count($query) == 1) {
            foreach ($query as $key => $value) {
                if (
                    $query[$key]->codigo_persona == $codigo
                    && $query[$key]->fecha_inicio <= $ff
                    && $query[$key]->fecha_fin >= $fi
                    && $query[$key]->estado != 0
                ) {
                    Session::flash('error', 'ARCHIVO CON ERRORES');
                }
            }
        }   else {

        Session::flash('success', 'ARCHIVO CARGADO CORRECTAMENTE!');

        return new Registro([
            'codigo_persona' => $row[0],
            'tipo_documento_persona' => $row[1],
            'documento_persona' => $row[2],
            'nombre_persona' => $row[3],
            'reglab_persona' => $row[4],
            'uniorg_persona' => $row[5],
            'fecha_inicio_persona' => $row[6],
            'estado_persona' => $row[7],
            'tipo_permiso_id' => $row[8],
            'concepto_id' => $row[9],
            'anio_periodo' => $row[10],
            'fecha_inicio' => $row[11],
            'fecha_fin' => $row[12],
         ]);

        $per = DB::table('registros')
            ->where('codigo_persona', '=', $row[0])->get();

        return new DiasPersonal();

        foreach ($per as $key => $value) {
                $diaPer->id_registro = $per[$key]->id;
                $diaPer->inicial = 10;
                $diaPer->saldo = 10;
                $diaPer->save();
            }
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
