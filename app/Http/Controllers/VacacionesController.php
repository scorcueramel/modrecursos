<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;

class VacacionesController extends Controller
{
    public function index()
    {
        return view('vacaciones.index');
    }

    public function tablavacaciones()
    {
        $tblvacaciones = Registro::where('tipo_permiso_id', 1)
        ->get();
        return datatables()->of($tblvacaciones)
        ->addColumn('detalles',function ($row){
            return '<td><button type="button" class="btn btn-primary btn-sm" data-id="'.$row['id'].'" id="modalPendiente">Detalles</button></td>';
        })
        ->rawColumns(['nombres','detalles'])
        ->make(true);
    }
}
