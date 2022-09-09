<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;

class VacacionesController extends Controller
{
    public function index()
    {
        return view('vacaciones.index');
    }

    public function tablavacaciones(Request $request)
    {
        $tblvacaciones = Registro::where('tipo_permiso_id', 1)->get();
        return datatables()->of($tblvacaciones)
        ->addColumn('detalles',function ($row){
            return '<td><button type="button" class="btn btn-primary btn-sm" data-id="'.$row['id'].'" id="modalPendiente">Editar</button></td>';
        })
        ->filter(function($query) use ($request){
            if(!is_null($request->get('start_date')) && !is_null($request->get('end_date'))){
                $query->where('start_date', '>=',$request->get('start_date'))
                ->where('end_date', '<=',$request->get('end_date'));
            }
        })
        ->rawColumns(['detalles'])
        ->make(true);
    }
}
