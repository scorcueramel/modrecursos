<?php

namespace App\Http\Controllers;

use App\Exports\SuspensionesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Registro;

class SuspensionesController extends Controller
{
    public function index()
    {
        return view('suspensiones.index');
    }

    public function tablasuspensiones()
    {
        $tblsuspensiones = Registro::join('dias_personals','registros.id','=','dias_personals.id_registro')
            ->select('registros.id','registros.codigo_persona','registros.documento_persona','registros.nombre_persona','registros.reglab_persona','registros.uniorg_persona','registros.fecha_inicio','registros.fecha_fin','registros.anio_periodo','registros.documento','dias_personals.inicial as inicial')
            ->where('tipo_permiso_id','=',5);
        return datatables()->of($tblsuspensiones)
        ->addColumn('detalles',function ($row){
            return '<td>
                        <a href="" class="btn btn-warning btn-sm">Editar</a>
                    </td>';
        })
        ->addColumn('borrar',function ($row){
            return '<td><a href="desactivar/'.$row['id'].'" class="btn btn-danger btn-sm" id="borrar">Borrar</a></td>';
        })
        ->addColumn('docsus',function ($row){
            $docsus = "";
            if($row['documento'] == "")
            {
                $docsus = "Sin Documento";
            }else{
                $docsus = $row['documento'];
            }
            return $docsus;
        })
        ->rawColumns(['detalles','borrar','docsus'])
        ->make(true);
    }

    public function export()
    {
        return Excel::download(new SuspensionesExport, 'suspensiones.csv');
    }
}
