<?php

namespace App\Http\Controllers;

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
        $resp = $response->json(['contenido'][0]);
        // dd($resp);
        $tipopermiso = TipoPermiso::all();
        $concepto = Conceptos::all();

        return view('registro', compact('resp','tipopermiso','concepto'));
    }

    public function store(Request $request)
    {
        $resp = new Registro();
        $resp->codigo_persona = $request->codigo;
        $resp->documento_persona = $request->numdoc;
        $resp->nombre_persona = $request->nombre;
        $resp->reglab_persona = $request->reglab;
        $resp->uniorg_persona = $request->uniorg;
        $resp->estado_persona = "ACTIVO";
        $resp->fecha_inicio_persona = Carbon::now();
        $resp->tipo_permiso_id = $request->tipopermiso;
        $resp->fecha_inicio = Carbon::now();
        $resp->fecha_fin = Carbon::now();

        $resp->save();
        return redirect()->route('home');
    }
}
