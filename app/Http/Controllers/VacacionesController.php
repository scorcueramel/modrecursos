<?php

namespace App\Http\Controllers;

use App\Models\Registro;

class VacacionesController extends Controller
{
    public function index()
    {
        return view('vacaciones.index');
    }

    public function tablavacaciones()
    {
        $tblvacaciones = Registro::where('tipo_permiso_id', 1)->get();
        return datatables()->of($tblvacaciones)
        ->addColumn('detalles',function ($row){
            return '<td><button type="button" class="btn btn-primary btn-sm" data-id="'.$row['id'].'" id="modalPendiente">Editar</button></td>';
        })
        ->rawColumns(['detalles'])
        ->make(true);
    }
}
