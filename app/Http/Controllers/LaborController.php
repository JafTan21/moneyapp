<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaborController extends Controller
{
    public function index()
    {
        return view('labor.index');
    }
}