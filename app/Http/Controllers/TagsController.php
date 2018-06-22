<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->with(['tags' => function ($q){
            $q->with(['subcategory' => function ($query){
                $query->with('category');
            }]);
        }])->with('photos')->with('owner')->latest('published_at')->paginate();

        return view('pages.home', ['posts' => $posts,
        'title' => "Reportes de la etiqueta {$tag->name}"]);
    }
}
