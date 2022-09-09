<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Registro;
use App\Models\TipoPermiso;
use App\Models\Conceptos;
use Carbon\Carbon;

class TestController extends Controller
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
        'conceptos'=>$conceptos]);
    }

    public function store(Request $request)
    {
        $respuesta = "";
        $resp = new Registro();
        $resp->usuario_creador=Auth::user()->name;
        $resp->codigo_persona = $request->codigo;
        $resp->documento_persona = $request->documento_persona;
        $resp->nombre_persona = $request->nombres;
        $resp->reglab_persona = $request->reglaboral;
        $resp->uniorg_persona = $request->uniorg;
        $resp->estado_persona = $request->estado;
        if($request->tpermiso == "SELECCIONAR")
        {
            $respuesta = "No Elejiste un tipo de permiso, vuelve a intentarlo!";
            return back()->with('error', $respuesta);
        }else{
            $resp->tipo_permiso_id = $request->tpermiso;
        }
        $resp->fecha_inicio = Carbon::parse($request->fecinicio);
        $resp->fecha_fin = Carbon::parse($request->fecfin);
        $resp->fecha_inicio_persona = Carbon::parse($request->ingreso);
        $resp->concepto_id = $request->concepto;
        $resp->documento = $request->documento_ref;
        $resp->ip_usuario = request()->ip();
        $resp->usuario_editor = null;
        $resp->estado = 1;
        $resp->save();

        return redirect()->route('home')->with('success','Se generó el registro exitosamente');

    }

    public function desactivar($id)
    {
        $registro = Registro::find($id);
        $registro->comentario = "ELIMINADO";
        $registro->estado = 0;
        $registro->deleted_at = Carbon::now()->toDateTimeString();
        $registro->update();
    }
}
