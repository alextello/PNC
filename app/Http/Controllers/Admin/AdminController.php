<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plantilla;

class AdminController extends Controller
{
    
    public function index()
    {
        $plantillas = Plantilla::all();
        return view('admin.dashboard', compact('plantillas'));
    }
}
