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
            return '<td><button type="button" class="btn btn-warning btn-sm" data-id="'.$row['id'].'" id="modalPendiente">Editar</button></td>';
        })
        ->rawColumns(['detalles'])
        ->make(true);
    }

    public function export()
    {
        return Excel::download(new SuspensionesExport, 'suspensiones.csv');
    }
}
