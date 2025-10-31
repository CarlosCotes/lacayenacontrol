<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VigilanteController extends Controller
{
    public function index()
    {
        return view('vigilante.index'); 
    }
    
}
