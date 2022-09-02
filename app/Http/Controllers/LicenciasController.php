<?php

namespace App\Http\Controllers;

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
            return '<td><button type="button" class="btn btn-primary btn-sm" data-id="'.$row['id'].'" id="modalPendiente">Detalles</button></td>';
        })
        ->rawColumns(['nombres','detalles'])
        ->make(true);
    }
}