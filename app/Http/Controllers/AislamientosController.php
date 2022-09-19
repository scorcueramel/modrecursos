<?php

namespace App\Http\Controllers;

use App\Exports\AislamientosExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Registro;

class AislamientosController extends Controller
{
    public function index()
    {
        return view('aislamientos.index');
    }

    public function tablaaislamientos()
    {
        $tblaislamientos = Registro::join('dias_personals','registros.id','=','dias_personals.id_registro')
            ->select('registros.id','registros.codigo_persona','registros.documento_persona','registros.nombre_persona','registros.reglab_persona','registros.uniorg_persona','registros.fecha_inicio','registros.fecha_fin','registros.anio_periodo','registros.documento','dias_personals.inicial as inicial')
            ->where('tipo_permiso_id','=',4);
        return datatables()->of($tblaislamientos)
        ->addColumn('detalles',function ($row){
            if (auth()->user()->can('EDITAR-AISLAMIENTOS'))
            {
                return '<td>
                            <a href="" class="btn btn-warning btn-sm">Editar</a>
                        </td>';
            }
        })
        ->addColumn('borrar',function ($row){
            if (auth()->user()->can('BORRAR-AISLAMIENTOS'))
            {
                return '<td>
                            <button type="button" class="btn btn-danger btn-sm" data-id="'.$row['id'].'" id="borrar">Borrar</a>
                        </td>';
            }
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
        return Excel::download(new AislamientosExport, 'aislamientos.csv');
    }
}
