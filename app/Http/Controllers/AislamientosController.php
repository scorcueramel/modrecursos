<?php

namespace App\Http\Controllers;

use App\Exports\AislamientosExport;
use App\Models\DiasPersonal;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Registro;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AislamientosController extends Controller
{
    public function index()
    {
        return view('aislamientos.index');
    }

    public function tablaaislamientos()
    {
        $tblaislamientos = Registro::join('dias_personals', 'registros.id', '=', 'dias_personals.id_registro')
            ->select('registros.id', 'registros.codigo_persona', 'registros.documento_persona', 'registros.nombre_persona', 'registros.reglab_persona', 'registros.uniorg_persona', 'registros.fecha_inicio', 'registros.fecha_fin', 'registros.anio_periodo', 'registros.documento', 'registros.comentario', 'dias_personals.inicial as inicial')
            ->where('tipo_permiso_id', '=', 4);
        return datatables()->of($tblaislamientos)
            ->addColumn('editar', function ($row) {
                if (auth()->user()->can('EDITAR-AISLAMIENTOS')) {
                    return '<td>
                            <a href="registro/' . $row['id'] . '/editar" class="btn btn-warning btn-sm">Editar</a>
                        </td>';
                }
            })
            ->addColumn('borrar', function ($row) {
                if (auth()->user()->can('BORRAR-AISLAMIENTOS')) {
                    return '<td>
                            <button type="button" class="btn btn-danger btn-sm" data-id="' . $row['id'] . '" id="borrar">Borrar</a>
                        </td>';
                }
            })
            ->addColumn('docsus', function ($row) {
                $docsus = "";
                if ($row['documento'] == "") {
                    $docsus = "S/D";
                } else {
                    $docsus = $row['documento'];
                }
                return $docsus;
            })
            ->addColumn('periodo', function ($row) {
                $periodo = "";
                if ($row['anio_periodo'] == "") {
                    $periodo = "S/P";
                } else {
                    $periodo = $row['anio_periodo'];
                }
                return $periodo;
            })
            ->addColumn('obs', function ($row) {
                $obs = "";
                if ($row['comentario'] == "") {
                    $obs = "S/O";
                } else {
                    $obs = $row['comentario'];
                }
                return $obs;
            })
            ->rawColumns(['editar', 'borrar', 'docsus', 'periodo', 'obs'])
            ->make(true);
    }

    public function export(Request $request)
    {
        //fechas para filtro
        $min = date('Y-m-d',strtotime($request->min));
        $max = date('Y-m-d',strtotime($request->max));

        return Excel::download(new AislamientosExport($min, $max), 'aislamientos.csv');
    }
}
