<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class EstadisticasController extends Controller
{
    public function tag()
    {
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

    
    public function fecha()
    {
        $fechas = explode(' ', request()->fecha);
        $tags = DB::table('post_tag')
        ->select(DB::raw('count(tag_id) as cantidad'))
        ->join('posts', 'posts.id', '=', 'post_tag.post_id')
        ->join('tags', 'post_tag.tag_id', '=', 'tags.id')
        ->where('posts.published_at', '>', Carbon::createFromFormat('d/m/Y', $fechas[0]))
        ->where('posts.published_at', '<', Carbon::createFromFormat('d/m/Y', $fechas[2]))
        ->groupBy('tag_id')
        ->addSelect('tags.name')
        ->get();
        return response()->json(array(
            'tags' => $tags,
            'fechas' => $fechas
        ));
    }

    public function fechacat()
    {
        $fechas = explode(' ', request()->fecha);
        $cats = DB::table('posts')
        ->join('categories', 'posts.category_id', '=', 'categories.id')
        ->select(DB::raw('count(posts.category_id) as cantidad'))
        ->where('posts.published_at', '>', Carbon::createFromFormat('d/m/Y', $fechas[0]))
        ->where('posts.published_at', '<', Carbon::createFromFormat('d/m/Y', $fechas[2]))
        ->groupBy('posts.category_id')
        ->addSelect('categories.name')
        ->get();
        return response()->json(array(
            'tags' => $cats,
            'fechas' => $fechas
        ));
    }

    public function auth()
    {
        return view('admin.charts.index');
    }

    public function cat()
    {
        return view('admin.charts.index');
    }

    public function totalcat()
    {
        $cats = DB::table('posts')
        ->join('categories', 'posts.category_id', '=', 'categories.id')
        ->select(DB::raw('count(posts.category_id) as cantidad'))
        ->groupBy('posts.category_id')
        ->addSelect('categories.name')
        ->get();
        return $cats;
    }
    // select count(tag_id), tags.name from post_tag 
    // inner join posts on posts.id = post_tag.post_id
    //  inner join tags on post_tag.tag_id = tags.id where posts.published_at > TIMESTAMP '2017/01/01 18:33:55' and posts.published_at < TIMESTAMP '2019/01/01 18:33:55' group by tag_id;
}
