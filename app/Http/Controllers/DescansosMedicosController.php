<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DescansosMedicosController extends Controller
{
    public function index()
    {
        return view('descansomedico.index');
    }
}
