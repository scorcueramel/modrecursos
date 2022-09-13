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
        $tblaislamientos = Registro::where('tipo_permiso_id', 4)
        ->get();
        return datatables()->of($tblaislamientos)
        ->addColumn('detalles',function ($row){
            return '<td><button type="button" class="btn btn-warning btn-sm" data-id="'.$row['id'].'" id="modalPendiente">Editar</button></td>';
        })
        ->rawColumns(['detalles'])
        ->make(true);
    }
    
    public function export() 
    {
        return Excel::download(new AislamientosExport, 'aislamientos.csv');
    }
}
