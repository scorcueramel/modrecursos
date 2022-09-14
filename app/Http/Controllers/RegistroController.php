<?php

namespace App\Http\Controllers;

use Auth;

use App\Imports\RegistrosImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Registro;
use App\Models\TipoPermiso;
use App\Models\Conceptos;
use App\Models\DiasPersonal;
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
            ->where('registros.estado', '>', 0)
            ->get();

        $resp = new Registro();
        $resp->usuario_creador = Auth::user()->name;
        $resp->codigo_persona = $codigo;
        $resp->tipo_documento_persona = $request->tipo_documento_persona;
        $resp->documento_persona = $request->documento_persona;
        $resp->nombre_persona = $request->nombres;
        $resp->reglab_persona = $request->reglaboral;
        $resp->uniorg_persona = $request->uniorg;
        $resp->estado_persona = $request->estado;
        if ($request->tpermiso == "SELECCIONAR") {
            $msn = "No Elegiste un tipo de permiso, vuelve a intentarlo!";
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
                    && $persona[$key]->estado != 0
                ) {
                    $msn = "Actualmente cuenta con " . $persona[$key]->descripcion . " en el rango de fecha seleccionado";
                    return back()->with('error', $msn);
                }
            }
        } else {
            $resp->fecha_inicio = $fi;
            $resp->fecha_fin = $ff;
        }
        $resp->fecha_inicio_persona = Carbon::parse($request->ingreso);
        $resp->concepto_id = $request->concepto;
        $resp->anio_periodo = $request->anioperiodo;
        $resp->documento = $request->documento_ref;
        $resp->comentario = $request->observaciones;
        $resp->ip_usuario = request()->ip();
        $resp->usuario_editor = null;
        $resp->estado = 1;
        $resp->save();

        $per = DB::table('registros')
            ->where('codigo_persona', '=', $request->codigo)->get();

        $diaPer = new DiasPersonal();

        foreach ($per as $key => $value) {
            $diaPer->id_registro = $per[$key]->id;
            $diaPer->inicial = $request->diaspersonal;
            $diaPer->saldo = $request->diaspersonal;
            $diaPer->save();
        }
        $msn = 'Se generó el registro exitosamente';
        return redirect()->route('home')->with('success', $msn);
    }

    public function desactivar(Request $request)
    {

        $msn = "Se elimino el registro, ya no lo podrás ver en la tabla";
        $id_registro = $request->id;

        $registro = Registro::find($id_registro);

        if ($registro) {
            $registro->usuario_editor = Auth::user()->name;
            $registro->estado = 0;
            $registro->deleted_at = Carbon::now()->toDateTimeString();
            $registro->ip_usuario = request()->ip();
            $registro->update();
            return response()->json(['code' => 1, 'msn' => $msn]);
        } else {
            return response()->json(['code' => 0, 'msn' => 'No se elimino el registro']);
        }
    }

    public function cargamasiva()
    {
        return view('cargamasiva');
    }

    public function import(Request $request)
    {
        Excel::import(new RegistrosImport, $request->file);
        return redirect()->back()->with('warning', 'Archivo cargado correctamente!');
    }
}
