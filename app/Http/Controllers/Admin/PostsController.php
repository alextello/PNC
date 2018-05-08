<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use Carbon\Carbon;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $post = Post::create(['title' => $request->get('title'),
                            'url' => str_slug($request->get('title'))]);

        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    // public function store(Request $request)
    // {
    //     $this->validate($request,[
    //         'title' => 'required'
    //     ]);

    //     $post = new Post();
    //     $post->title = $request->title;
    //     $post->url = str_slug($request->title);
    //     $post->body = $request->body;
    //     $post->excerpt = $request->excerpt;
    //     $post->published_at = Carbon::parse($request->published_at);
    //     $post->category_id = $request->category;
    //     $post->save();
    //     //tags pendientes
    //     $post->tags()->attach($request->tags);

    //     return back()->with('flash', 'Reporte creado');

    // }
}
