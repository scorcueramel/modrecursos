<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EditarController extends Controller
{
    public function edit($id)
    {
        $registro = DB::table('dias_personals')
            ->join('registros','registros.id','=','dias_personals.id_registro')
            ->where('dias_personals.id_registro','=',$id)
            ->get();
//        dd($registro);
        return view('editar', compact('registro'));
    }
}
