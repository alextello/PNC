<?php

namespace App\Http\Controllers;

use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function show(Tag $tag, Request $request)
    {
        if($request->filled('reservation'))
        {   
         $fechas = explode(' ', $request->reservation); 
         $posts = $tag->posts()->with(['tags' => function ($q){
                $q->with(['subcategory' => function ($query){
                    $query->with('category');
                }]);
            }])->with(['address' => function($a){
                $a->with('municipio');
            }])->with('photos')->with('owner')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->where('published_at', '>', Carbon::createFromFormat('d/m/Y', $fechas[0])->subDays(1))
            ->where('published_at', '<', Carbon::createFromFormat('d/m/Y', $fechas[2]))
            ->paginate();
        }

        else{
            $posts = $tag->posts()->with(['tags' => function ($q){
                $q->with(['subcategory' => function ($query){
                    $query->with('category');
                }]);
            }])->with(['address' => function($a){
                $a->with('municipio');
            }])->with('photos')->with('owner')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate();
        }

        return view('pages.home', ['posts' => $posts,
        'title' => "Reportes de la etiqueta {$tag->name}"]);
    }
}
