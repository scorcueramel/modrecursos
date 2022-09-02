<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;

class SuspensionesController extends Controller
{
    public function index()
    {
        return view('suspensiones.index');
    }

    public function tablasuspensiones()
    {
        $tblsuspensiones = Registro::where('tipo_permiso_id', 5)
        ->get();
        return datatables()->of($tblsuspensiones)
        ->addColumn('detalles',function ($row){
            return '<td><button type="button" class="btn btn-primary btn-sm" data-id="'.$row['id'].'" id="modalPendiente">Detalles</button></td>';
        })
        ->rawColumns(['detalles'])
        ->make(true);
    }
}