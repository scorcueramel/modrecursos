<?php

namespace App\Http\Controllers;

use App\Exports\DescansosMedicosExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Registro;

class DescansosMedicosController extends Controller
{
    public function index()
    {
        return view('descansomedico.index');
    }

    public function tabladescansosmedicos()
    {
        $tbldescansosmedicos = Registro::join('dias_personals','registros.id','=','dias_personals.id_registro')
            ->select('registros.id','registros.codigo_persona','registros.documento_persona','registros.nombre_persona','registros.reglab_persona','registros.uniorg_persona','registros.fecha_inicio','registros.fecha_fin','registros.anio_periodo','registros.documento','dias_personals.inicial as inicial')
            ->where('tipo_permiso_id','=',2);
        return datatables()->of($tbldescansosmedicos)
        ->addColumn('editar',function ($row){
            if (auth()->user()->can('EDITAR-DESCANSOS-MEDICOS'))
            {
                return '<td>
                            <a href="" class="btn btn-warning btn-sm">Editar</a>
                        </td>';
            }
        })
        ->addColumn('borrar',function ($row){
            if (auth()->user()->can('BORRAR-DESCANSOS-MEDICOS')){
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
        ->rawColumns(['editar','borrar','docsus'])
        ->make(true);
    }

    public function export()
    {
        return Excel::download(new DescansosMedicosExport, 'descansosmedicos.csv');
    }
}
