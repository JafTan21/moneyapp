<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContractedFormController extends Controller
{
    public function index()
    {
        return view('contractedform.index');
    }
}