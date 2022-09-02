<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AislamientosController extends Controller
{
    public function index()
    {
        return view('aislamientos.index');
    }
}
