<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubContractorController extends Controller
{
    public function index()
    {
        return view('sub-contractor.index');
    }
}