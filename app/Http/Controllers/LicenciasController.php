<?php

namespace App\Http\Controllers;

use App\Exports\LicenciasExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Registro;

class LicenciasController extends Controller
{
    public function index()
    {
        return view('licencias.index');
    }

    public function tablalicencias()
    {
        $tbllicencias = Registro::where('tipo_permiso_id', 3)
        ->get();
        return datatables()->of($tbllicencias)
        ->addColumn('detalles',function ($row){
            return '<td><button type="button" class="btn btn-warning btn-sm" data-id="'.$row['id'].'" id="modalPendiente">Editar</button></td>';
        })
        ->rawColumns(['detalles'])
        ->make(true);
    }

    public function export() 
    {
        return Excel::download(new LicenciasExport, 'licencias.csv');
    }
}
