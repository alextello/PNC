<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request)
    {
    //     if(request()->filled('reservation'))
    //     {
    //         $fechas = explode(' ', $request->reservation);
            // $cat = $category->tags()->get()->pluck('id');
    //         $posts = Post::with(['tags' => function ($q){
    //             $q->with(['subcategory' => function ($query){
    //                 $query->with('category');
    //             }]);
    //         }])->with(['address' => function($a){
    //             $a->with('aldea');
    //         }])->with('photos')->with('owner')->whereIn('tag_id', $cat)
    //         ->whereNotNull('published_at')
    //         ->latest('published_at')
    //         ->where('published_at', '>', Carbon::createFromFormat('d/m/Y', $fechas[0])->subDays(1))
    //         ->where('published_at', '<', Carbon::createFromFormat('d/m/Y', $fechas[2]))
    //         ->paginate();
    //     }
    //     else
    //     {
    //     $cat = $category->tags()->get()->pluck('id');
    //     $posts = Post::with(['tags' => function ($q){
    //         $q->with(['subcategory' => function ($query){
    //             $query->with('category');
    //         }]);
    //     }])->with(['address' => function($a){
    //         $a->with('aldea');
    //     }])->with('photos')->with('owner')->whereIn('tag_id', $cat)
    //     ->whereNotNull('published_at')
    //     ->latest('published_at')
    //     ->paginate();
    // }
    $cat = $category->tags()->get()->pluck('id');
    $posts = Post::with(['tags' => function ($q){
                $q->with(['subcategory' => function ($query){
                    $query->with('category');
                }]);
            }])->with(['address' => function($a){
                $a->with('aldea');
            }])->with('photos')->with('owner')->whereIn('tag_id', $cat)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate();
    if(request()->wantsJson())
    return $posts;
    else
    return view('pages.home', ['posts' => $posts,
                                'title' => "Reportes de la categoria {$category->name}"]);
        
    }
}
