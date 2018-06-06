<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EstadisticasController extends Controller
{
    public function tag()
    {
        // $tags = DB::table('post_tag')
        // ->select('tag_id', DB::raw('count(*) as tag'))
        // ->groupBy('tag_id')
        // ->get();
        
        // $tags = Post::with(['tags' => function ($query) {
        //     $query->where('title', 'like', '%first%');
        // }])->get();
        return view('admin.charts.index');
    }

    public function total()
    {

        $tags = DB::table('post_tag')
            ->join('tags', 'post_tag.tag_id', '=', 'tags.id')
            ->select(DB::raw('count(tag_id) as cantidad'))
            ->groupBy('tag_id')
            ->addSelect('tags.name')
            ->get();
            return $tags;
            
    }

    public function auth()
    {
        return view('admin.charts.index');
    }

    public function fecha()
    {
        $fechas = explode(' ', request()->fecha);
        return $fechas[0].'ssss'.$fechas[2]; 
    }
}
