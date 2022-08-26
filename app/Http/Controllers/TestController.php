<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index()
    {
        // $response = Http::get('https://jsonplaceholder.typicode.com/users');

        $response = Http::get('http://sistemas.munisurco.gob.pe/pidemss/servicios/siam/dat?P_APEPATERNO=CORCUERA&P_APEMATERNO=&P_CODIGO=0&P_VCHTIDCODIGO=&P_NUMDOCUMENTO=&entidad=201&sistema=603&key=400');

        $resp = json_encode($response);

        return response()->json(['resp'=>$resp]);
    }
}
