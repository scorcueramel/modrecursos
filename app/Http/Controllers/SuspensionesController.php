<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuspensionesController extends Controller
{
    public function index()
    {
        return view('suspensiones.index');
    }
}
