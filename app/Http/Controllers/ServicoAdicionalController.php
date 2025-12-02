<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Hospede;

class ServicoAdicionalController extends Controller
{
   
    public function servicoAdicional()
    {
        return view('servicoAdicional.dashboard');
}
}

