<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plantilla;

class PlantillaSelectController extends Controller
{
    public function index()
    {
        return $plantilla = Plantilla::find(request()->plantilla);
    }
}
