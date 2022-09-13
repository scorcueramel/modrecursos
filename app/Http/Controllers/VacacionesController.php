<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VacacionesController extends Controller
{
    public function index()
    {
        return view('vacaciones.index');
    }

    public function tablavacaciones(Request $request)
    {
        $tblvacaciones = Registro::where('tipo_permiso_id', 1);
//        $tblvacaciones = DB::table('registros')
//            ->where('tipo_permiso_id','=',1)
//            ->join('dias_personals','registros.id','=','dias_personals.id_registro')
//            ->select(['dias_personals.id','dias_personals.inicial'])
//            ->get();

        return datatables()->of($tblvacaciones)
        ->addColumn('detalles',function ($row){
            return '<td><button type="button" class="btn btn-warning btn-sm" data-id="'.$row['id'].'" id="modalPendiente">Editar</button></td>';
        })
//        ->editColumn('diaspermiso',function ($row)
//        {
//            return '<td>'.$row->incial.'</td>';
//        })
        ->rawColumns(['detalles','diaspermiso'])
        ->make(true);
    }
}
