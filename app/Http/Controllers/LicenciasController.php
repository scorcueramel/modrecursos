<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LicenciasController extends Controller
{
    public function index()
    {
        return view('licencias.index');
    }
}
