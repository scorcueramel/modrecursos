<?php

namespace App\Http\Controllers;

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
        $tblaislamientos = Registro::where('tipo_permiso_id', 4)
        ->get();
        return datatables()->of($tblaislamientos)
        ->addColumn('detalles',function ($row){
            return '<td><button type="button" class="btn btn-primary btn-sm" data-id="'.$row['id'].'" id="modalPendiente">Detalles</button></td>';
        })
        ->rawColumns(['detalles'])
        ->make(true);
    }
}