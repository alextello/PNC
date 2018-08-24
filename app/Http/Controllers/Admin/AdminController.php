<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\User;
use App\Plantilla;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    
    public function index()
    {
        $plantillas = Plantilla::all();
        $usuarios = User::all()->count();
        $month = Carbon::now()->month;
        $posts = DB::table('posts')->whereMonth('published_at', $month)->count();
        $aprehendidos = DB::table('involucrados')
        ->join('involucrado_post', 'involucrado_post.involucrado_id', '=', 'involucrados.id')
        ->where('aprehendido', '1')->whereMonth('involucrado_post.created_at', $month)->count();
        // dd($aprehendidos);
        return view('admin.dashboard', compact('plantillas', 'usuarios', 'posts', 'aprehendidos'));
    }
}
