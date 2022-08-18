<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $conceptosDM = DB::select('select * from descanso_medico_conceptos where Estado = ?', [1]);
        $conceptosLIC = DB::select('select * from licencia_conceptos where Estado = ?', [1]);
        return view('home', compact('conceptosDM','conceptosLIC'));
    }
}
