<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        $cat = $category->tags()->get()->pluck('id');
        $posts = Post::with(['tags' => function ($q){
            $q->with(['subcategory' => function ($query){
                $query->with('category');
            }]);
        }])->with('photos')->with('owner')->whereIn('tag_id', $cat)->latest('published_at')->paginate();

        return view('pages.home', ['posts' => $posts,
                                'title' => "Reportes de la categoria {$category->name}"]);
        
    }
}
