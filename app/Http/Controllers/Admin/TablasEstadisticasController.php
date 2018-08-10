<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TablasEstadisticasController extends Controller
{
    public function hechosNegativos(Request $request)
    {
  
        if($request->method() == 'POST')
            $year = $request->Buscar;
        else
            $year = Carbon::now()->year;
        
        $query =  DB::table('posts')
                ->join('tags', 'tags.id', '=', 'posts.tag_id')
                ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
                ->select('tags.name', DB::raw('MONTH(published_at) as mes'), DB::raw('count(posts.tag_id) as cantidad'))
                ->whereYear('published_at', '=', $year)
                ->where('subcategories.category_id', '=', '2')
                ->groupBy('tags.name', 'mes')
                ->orderBy('mes', 'asc')
                ->get();
        
        $tags = collect();
        $vacios = collect();

        foreach($query as $q)
        {
            $tags[$q->name] = collect(['name' => $q->name]);
            $tags[$q->name]['meses'] = collect();
        }
        
        $tags = $tags->unique();
        foreach($query as $q)
        {
            foreach($tags as $tag)
            {
                if($tag->contains($q->name))
                {
                   $tag['meses']->put($q->mes, $q->cantidad);
                }
            }
           
        }
        
        $meses = collect([1 => 0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0, 12=>0]);

        foreach($tags as $tag)
        {
            $names[] = $tag['name'];
            $tag['meses'] = $tag['meses']->union($meses);
            $tag['meses'] = $tag['meses']->sortKeys();
        }
        
        $nullTags = DB::table('tags')
        ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
        ->where('subcategories.category_id', '2')
        ->select('tags.name')
        ->get();

        foreach($nullTags as $null)
        {
            $vacios[$null->name] = collect(['name' => $null->name]);
            $vacios[$null->name]['meses'] = $meses;
        }
        
        $tags = $tags->union($vacios);
        return view('admin.TablasEstadisticas.negativos', compact('tags', 'year'));

    }
}
