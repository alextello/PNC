<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoriesController extends Controller
{
    public function show(Subcategory $subcategory)
    {
        // // $posts = DB::table('posts', 'subcategories')
        // // ->join('tags', 'tags.id', '=', 'posts.tag_id')
        // // ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
        // // ->where('subcategories.id', '=', $subcategory->id)
        // // ->select('posts.*')
        // // ->paginate();
        // $posts = $subcategory->tags()->get()->posts();
        // dd($posts);
        return view('pages.home', ['posts' => $subcategory->posts()->paginate(),
        'title' => "Reportes de la categoria {$subcategory->name}"]);
    }
}
