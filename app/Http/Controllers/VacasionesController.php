<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;

class VacasionesController extends Controller
{
    public function index()
    {
        return view('vacaciones.index');
    }

    public function tablavacaciones()
    {
        $tblvacaciones = Registro::all();
        return datatables()->of($tblvacaciones)
        ->addColumn('detalles',function ($row){
            return '<td><button type="button" class="btn btn-primary btn-sm" data-id="'.$row['id'].'" id="modalPendiente">Detalles</button></td>';
        })
        ->rawColumns(['detalles'])
        ->make(true);
    }
}
