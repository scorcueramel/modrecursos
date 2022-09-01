<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VacasionesController extends Controller
{
    public function index()
    {
        return view('vacaciones.index');
    }
}
