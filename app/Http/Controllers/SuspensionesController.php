<?php

namespace App\Http\Controllers;

use App\Exports\SuspensionesExport;
use Maatwebsite\Excel\Facades\Excel;
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
            return '<td><button type="button" class="btn btn-warning btn-sm" data-id="'.$row['id'].'" id="modalPendiente">Editar</button></td>';
        })
        ->rawColumns(['detalles'])
        ->make(true);
    }
    
    public function export() 
    {
        return Excel::download(new SuspensionesExport, 'suspensiones.csv');
    }
}
