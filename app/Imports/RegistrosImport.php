<?php

namespace App\Imports;

use App\Models\DiasPersonal;
use App\Models\Registro;
use App\Models\ResponseDTO;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\DB;

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
        ->join('dias_personals', 'registros.id','=','dias_personals.id_registro')
        ->where('codigo_persona', '=', $codigo)
        ->whereDate('fecha_inicio', '<=', $ff)
        ->whereDate('fecha_fin', '>=', $fi)
        ->where('deleted_at', '=', null)
        ->get();

        dd($query);

        foreach($query as $key => $value)
        {
            $nuevo = new Registro([
                'codigo_persona' => $query[$key]->codigo_persona,
                'tipo_documento_persona' => $row[1],
                'documento_persona' => $row[2],
                'nombre_persona' => $row[3],
                'reglab_persona' => $row[4],
                'uniorg_persona' => $row[5],
                'fecha_inicio_persona' => $row[6],
                'estado_persona' => $row[7],
                'tipo_permiso_id' => $row[8],
                'concepto_id' => $row[9],
                'fecha_inicio' => $row[10],
                'fecha_fin' => $row[11],
                // 'documento' => $row[11],
                // 'comentario' => $row[12],
                // 'usuario_creador' => $row[13],
                // 'usuario_editor' => $row[14],
                // 'ip_usuario' => $row[15],
                // 'estado' => $row[16],
             ]);
             $con = DB::table('registros')
             ->where('codigo_persona', '=', )
             ->get();
            //  $dp = new DiasPersonal([

            //  ])
            return response()->json(['success'=>"Carga exitosa"]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}
