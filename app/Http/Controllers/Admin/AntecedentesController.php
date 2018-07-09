<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Involucrado;
use App\Post;

class AntecedentesController extends Controller
{
    public function index()
    {
        $inv = Involucrado::with('posts')->get();
        return view('admin.antecedentes.index', compact('inv'));
    }

    public function posts($id)
    {
        $posts = Involucrado::find($id)->posts()->with(['tags' => function ($q){
            $q->with(['subcategory' => function ($query){
                $query->with('category');
            }]);
        }])->with(['address' => function($a){
            $a->with('municipio');
        }])->with('photos')->with('owner')
        ->whereNotNull('published_at')
        ->latest('published_at')
        ->paginate();
        // dd($post);
        return view('pages.home', compact('posts'));
    }
}
