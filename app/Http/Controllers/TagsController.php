<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        return view('pages.home', ['posts' => $tag->posts()->paginate(),
        'title' => "Reportes de la etiqueta {$tag->name}"]);
    }
}
