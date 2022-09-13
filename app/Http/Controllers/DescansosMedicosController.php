<?php

namespace App\Http\Controllers;

use App\Exports\DescansosMedicosExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Registro;

class DescansosMedicosController extends Controller
{
    public function index()
    {
        return view('descansomedico.index');
    }

    public function tabladescansosmedicos()
    {
        $tbldescansosmedicos = Registro::where('tipo_permiso_id', 2)
        ->get();
        return datatables()->of($tbldescansosmedicos)
        ->addColumn('detalles',function ($row){
            return '<a class="btn btn-warning btn-sm" href="delete/'.$row['codigo_persona'].'">Editar</a>';
        })
        ->rawColumns(['detalles'])
        ->make(true);
    }
    
    public function export() 
    {
        return Excel::download(new DescansosMedicosExport, 'descansosmedicos.csv');
    }
}
