<?php

namespace App\Imports;

use App\Models\Registro;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;

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
            'fecha_inicio' => $row[10], 
            'fecha_fin' => $row[11], 
            // 'documento' => $row[11], 
            // 'comentario' => $row[12], 
            // 'usuario_creador' => $row[13], 
            // 'usuario_editor' => $row[14], 
            // 'ip_usuario' => $row[15], 
            // 'estado' => $row[16], 
         ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
