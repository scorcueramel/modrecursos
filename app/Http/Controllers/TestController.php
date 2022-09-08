<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Conceptos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Registro;
use App\Models\TipoPermiso;
use Carbon\Carbon;

class TestController extends Controller
{
    public function edit($codigo)
    {
        $response = Http::acceptJson()->get('http://sistemas.munisurco.gob.pe/pidemss/servicios/siam/dat?P_APEPATERNO=&P_APEMATERNO=&P_CODIGO=' . $codigo . '&P_VCHTIDCODIGO=&P_NUMDOCUMENTO=&entidad=201&sistema=603&key=400');
        $tipopermisos = TipoPermiso::all();
        $resp = $response->json(['contenido'][0]);
        return view('registro', compact('resp', 'tipopermisos'));
    }

    public function conceptos()
    {
        $conceptos = Conceptos::all();
        return response()->json([
        'success'=>true,
        'conceptos'=>$conceptos]);
    }

    public function store(Request $request)
    {    
        $resp = new Registro();
        $resp->usuario_creador=Auth::id();
        $resp->codigo_persona = $request->codigo;
        $resp->documento_persona = $request->docident;
        $resp->nombre_persona = $request->nombres;
        $resp->reglab_persona = $request->reglab;
        $resp->uniorg_persona = $request->uniorg;
        $resp->estado_persona = $request->estado_persona;
        $resp->fecha_inicio_persona = Carbon::now();
        $resp->tipo_permiso_id = $request->tipopermiso;
        $resp->fecha_inicio = Carbon::now();
        $resp->fecha_fin = Carbon::now();
        $resp->fecha_inicio_persona = Carbon::parse($request->ingreso);
        $resp->estado_persona = "ACTIVO";
        $resp->tipo_permiso_id = $request->tpermiso;
        $resp->concepto_id = $request->concepto;
        $resp->fecha_inicio = Carbon::parse($request->fecinicio);
        $resp->fecha_fin = Carbon::parse($request->fecfin);
        $resp->documento = $request->documento;
        $resp->comentario = $request->comentario;
        $resp->ip_usuario = request()->ip();
        $resp->usuario_editor = null;
        $resp->estado = 1;
        $resp->save();
        return redirect()->route('home')->with('message', 'REGISTRO CREADO EXITOSAMENTE!');
        
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
