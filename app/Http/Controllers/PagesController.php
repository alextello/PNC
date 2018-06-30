<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use Carbon\Carbon;
use App\Subcategory;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(Request $request)
    {
        if($request->filled('reservation'))
        {
            $fechas = explode(' ', $request->reservation);
            $posts = Post::with(['tags' => function ($q){
                $q->with(['subcategory' => function ($query){
                    $query->with('category');
                }]);
            }])->with(['address' => function ($t){
                $t->with('municipio');
            }])->with('photos')->with('owner')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->where('published_at', '<=', Carbon::createFromFormat('d/m/Y', $fechas[2]))
            ->where('published_at', '>=', Carbon::createFromFormat('d/m/Y', $fechas[0]))
            ->paginate();
        }
        else
        {
            $posts = $this->helper();
        }
        return view('pages.home', compact('posts'));
    }

    public function helper()
    {
        $posts = Post::with(['tags' => function ($q){
            $q->with(['subcategory' => function ($query){
                $query->with('category');
            }]);
        }])->with(['address' => function($a){
            $a->with('municipio');
        }])->with('photos')->with('owner')
        ->whereNotNull('published_at')
        ->latest('published_at')->paginate();

        return $posts;
    }

    public function about()
    {
        return view('pages.about');
    }

    public function archive()
    {
        $posts = Post::latest('published_at')->take(5)->get();
        $categories = Category::all();
        $ptags = Category::where('id', 1)->first()->tags()->get();
        $ntags = Category::where('id', 2)->first()->tags()->get();
        $subcategories = Subcategory::all();
        return view('pages.archive', compact('posts', 'categories', 'ptags', 'ntags', 'subcategories'));
    }

    public function busqueda()
    {
        return view('pages.advanced');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
