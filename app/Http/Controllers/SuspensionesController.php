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
        ->addColumn('editar',function ($row){
            if (auth()->user()->can('EDITAR-SUSPENSIONES'))
            {
                return '<td>
                            <a href="registro/'.$row['id'].'/editar" class="btn btn-warning btn-sm">Editar</a>
                        </td>';
            }
        })
        ->addColumn('borrar',function ($row){
            if (auth()->user()->can('BORRAR-SUSPENSIONES'))
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
                $docsus = "S/D";
            }else{
                $docsus = $row['documento'];
            }
            return $docsus;
        })
        ->addColumn('periodo',function ($row){
            $docsus = "";
            if($row['anio_periodo'] == "")
            {
                $docsus = "S/P";
            }else{
                $docsus = $row['anio_periodo'];
            }
            return $docsus;
        })
        ->addColumn('obs',function ($row){
            $docsus = "";
            if($row['comentario'] == "")
            {
                $docsus = "S/O";
            }else{
                $docsus = $row['comentario'];
            }
            return $docsus;
        })
        ->rawColumns(['editar','borrar','docsus','periodo','obs'])
        ->make(true);
    }

    public function export()
    {
        return Excel::download(new SuspensionesExport, 'suspensiones.csv');
    }
}
