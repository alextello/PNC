<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use Carbon\Carbon;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoriesController extends Controller
{
    public function show(Subcategory $subcategory, Request $request)
    {
        // // $posts = DB::table('posts', 'subcategories')
        // // ->join('tags', 'tags.id', '=', 'posts.tag_id')
        // // ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
        // // ->where('subcategories.id', '=', $subcategory->id)
        // // ->select('posts.*')
        // // ->paginate();
        // $posts = $subcategory->tags()->get()->posts();
        // dd($posts);
        if($request->filled('reservation'))
        {
            $fechas = explode(' ', $request->reservation); 
            $posts = $subcategory->posts()->with(['tags' => function ($q){
                $q->with(['subcategory' => function ($query){
                    $query->with('category');
                }]);
            }])->with(['address' => function($a){
                $a->with('aldea');
            }])->with('photos')->with('owner')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->where('published_at', '>', Carbon::createFromFormat('d/m/Y', $fechas[0])->subDays(1))
            ->where('published_at', '<', Carbon::createFromFormat('d/m/Y', $fechas[2]))
            ->paginate();
        }
        else{
            $posts = $subcategory->posts()->with(['tags' => function ($q){
                $q->with(['subcategory' => function ($query){
                    $query->with('category');
                }]);
            }])->with(['address' => function($a){
                $a->with('aldea');
            }])->with('photos')->with('owner')
            ->whereNotNull('published_at')
            ->latest('published_at')->paginate();
        }


        return view('pages.home', ['posts' => $posts,
        'title' => "Reportes de la subcategoria {$subcategory->name}"]);
    }
}
