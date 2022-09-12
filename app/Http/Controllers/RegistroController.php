<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Registro;
use App\Models\TipoPermiso;
use App\Models\Conceptos;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{

    public function edit($codigo)
    {
        $response = Http::acceptJson()->get('http://sistemas.munisurco.gob.pe/pidemss/servicios/siam/dat?P_APEPATERNO=&P_APEMATERNO=&P_CODIGO=' . $codigo . '&P_VCHTIDCODIGO=&P_NUMDOCUMENTO=&entidad=201&sistema=603&key=400');
        $permisos = TipoPermiso::all();
        $resp = $response->json(['contenido'][0]);
        return view('registro', compact('resp', 'permisos'));
    }

    public function conceptos()
    {
        $conceptos = Conceptos::all();
        return response()->json([
            'conceptos' => $conceptos
        ]);
    }

    public function store(Request $request)
    {

        $msn = "";
        $codigo = $request->codigo;
        $fi = $request->fecinicio;
        $ff = $request->fecfin;

        $persona = DB::table('registros')
            ->join('tipo_permisos', function ($join) {
                $join->on('tipo_permisos.id', '=', 'registros.tipo_permiso_id');
            })
            ->where('codigo_persona', '=', $codigo)
            ->whereDate('fecha_inicio', '<=', $ff)
            ->whereDate('fecha_fin', '>=', $fi)
            ->get();

        $resp = new Registro();
        $resp->usuario_creador = Auth::user()->name;
        $resp->codigo_persona = $request->codigo;
        $resp->documento_persona = $request->documento_persona;
        $resp->nombre_persona = $request->nombres;
        $resp->reglab_persona = $request->reglaboral;
        $resp->uniorg_persona = $request->uniorg;
        $resp->estado_persona = $request->estado;
        if ($request->tpermiso == "SELECCIONAR") {
            $msn = "No Elejiste un tipo de permiso, vuelve a intentarlo!";
            return back()->with('error', $msn);
        } else {
            $resp->tipo_permiso_id = $request->tpermiso;
        }

        if (count($persona) > 0) {
            foreach ($persona as $key => $value) {
                if (
                    $persona[$key]->codigo_persona == $codigo
                    && $persona[$key]->fecha_inicio <= $ff
                    && $persona[$key]->fecha_fin >= $fi
                ) {
                    $msn = "Actualmente cuenta con " . $persona[$key]->descripcion . " en el rango de fecha seleccionado";
                    return back()->with('error', $msn);
                }
            }
        } else {
            $resp->fecha_inicio = $fi;
            $resp->fecha_fin = $ff;
            //    $msn = "Se puede otorgar el permiso";
            //    return back()->with('success', $msn);
        }
        $resp->fecha_inicio_persona = Carbon::parse($request->ingreso);
        $resp->concepto_id = $request->concepto;
        $resp->documento = $request->documento_ref;
        $resp->ip_usuario = request()->ip();
        $resp->usuario_editor = null;
        $resp->estado = 1;
        $resp->save();
        $msn = 'Se generó el registro exitosamente';
        return redirect()->route('home')->with('success', $msn);
    }

    public function desactivar($codigo)
    {
        $hoy = Carbon::now()->format('Y-m-d');

        $persona = DB::table('registros')->where('codigo_persona','=',$codigo)->get();

        foreach ($persona as $key => $value) {
            print_r($persona[$key]->nombre_persona);
        }
        // if($hoy <= $ff && $hoy >= $fi)
        // {
        //     dd("En curso");
        // }else
        // {
        //     dd("Puede Editar");
        // }


        // $persona = DB::table('registros')
        //     ->join('tipo_permisos', function ($join) {
        //         $join->on('tipo_permisos.id', '=', 'registros.tipo_permiso_id');
        //     })
        //     ->where('codigo_persona', '=', $codigo)
        //     ->whereDate('fecha_inicio', '<=', $ff)
        //     ->whereDate('fecha_fin', '>=', $fi)
        //     ->get();

        // foreach ($persona as $key => $value) {
        //     if($persona[$key]->codigo_persona == $codigo
        //         && $persona[$key]->fecha_inicio == $hoy)
        //     {
        //         dd('En curso');
        //     }
        // }
        // $registro = Registro::find($id);
        // $registro->comentario = "ELIMINADO";
        // $registro->estado = 0;
        // $registro->deleted_at = Carbon::now()->toDateTimeString();
        // $registro->update();
    }
}
