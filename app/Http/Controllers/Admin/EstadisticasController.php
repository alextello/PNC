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

        $tags = DB::table('posts')
            ->join('tags', 'posts.tag_id', '=', 'tags.id')
            ->select(DB::raw('count(tag_id) as cantidad'))
            ->groupBy('tag_id')
            ->addSelect('tags.name')
            ->orderBy('cantidad', 'desc')
            ->get();
            return $tags;
            
    }

    
    public function fecha()
    {
        $fechas = explode(' ', request()->fecha);
        $tags = DB::table('posts')
        ->select(DB::raw('count(tag_id) as cantidad'))
        ->join('tags', 'tags.id', '=', 'posts.tag_id')
        ->where('posts.published_at', '>', date(Carbon::createFromFormat('d/m/Y', $fechas[0])))
        ->where('posts.published_at', '<', date(Carbon::createFromFormat('d/m/Y', $fechas[2])))
        ->groupBy('posts.tag_id')
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
        ->join('tags', 'posts.tag_id', '=', 'tags.id')
        ->join('subcategories', 'tags.subcategory_id', '=', 'subcategories.id')
        ->join('categories', 'subcategories.category_id', '=', 'categories.id')
        ->select(DB::raw('count(subcategories.category_id) as cantidad'))
        ->where('posts.published_at', '>=', date(Carbon::createFromFormat('d/m/Y', $fechas[0])->subDays(1)))
        ->where('posts.published_at', '<=', date(Carbon::createFromFormat('d/m/Y', $fechas[2])))
        ->groupBy('subcategories.category_id')
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
        ->join('tags', 'tags.id', '=', 'posts.tag_id')
        ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
        ->select(DB::raw('count(subcategories.category_id) as cantidad'))
        ->join('categories', 'categories.id', '=', 'tags.subcategory_id')
        ->groupBy('subcategories.category_id', 'categories.name')
        ->addSelect('categories.name')
        ->get();
        return $cats;
    }
    
    public function personas()
    {
        return view('admin.charts.personas');
    }

    public function totalpersonas()
    {
        $personas =  DB::table('involucrados')
        ->join('involucrado_post', 'involucrado_post.involucrado_id', '=', 'involucrados.id')
        ->select(DB::raw('count(involucrado_post.post_id) as cantidad'))
        ->groupBy('involucrados.genero')
        ->addSelect('involucrados.genero')
        ->get();

        $personasFP =  DB::table('involucrados')
        ->join('involucrado_post', 'involucrado_post.involucrado_id', '=', 'involucrados.id')
        ->select(DB::raw('count(involucrado_post.post_id) as cantidad'))
        ->join('posts', 'posts.id', '=', 'involucrado_post.post_id')
        ->join('tags', 'posts.tag_id', '=', 'tags.id')
        ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
        ->join('categories', 'categories.id', '=', 'subcategories.category_id')
        ->groupBy('tags.name')
        ->addSelect('tags.name')
        ->where('involucrados.gender', 'F')
        ->where('categories.name', 'Categoria 1')
        ->get();

        $personasFN =  DB::table('involucrados')
        ->join('involucrado_post', 'involucrado_post.involucrado_id', '=', 'involucrados.id')
        ->select(DB::raw('count(involucrado_post.post_id) as cantidad'))
        ->join('posts', 'posts.id', '=', 'involucrado_post.post_id')
        ->join('tags', 'posts.tag_id', '=', 'tags.id')
        ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
        ->join('categories', 'categories.id', '=', 'subcategories.category_id')
        ->groupBy('tags.name')
        ->addSelect('tags.name')
        ->where('involucrados.gender', 'F')
        ->where('categories.name', 'Categoria 2')
        ->get();

        $personasM =  DB::table('involucrados')
        ->join('involucrado_post', 'involucrado_post.involucrado_id', '=', 'involucrados.id')
        ->select(DB::raw('count(involucrado_post.post_id) as cantidad'))
        ->groupBy('involucrados.genero')
        ->addSelect('involucrados.genero')->where('involucrados.gender', 'M')
        ->get();


        return response()->json(array(
            'personas' => $personas,
            'personasFP' => $personasFP,
            'personasFN' => $personasFN
        ));
    }
}
