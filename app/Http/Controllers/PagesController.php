<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PagesController extends Controller
{
    public function home()
    {
        $posts = Post::whereNotNull('published_at')->latest('published_at')->get();
        return view('welcome', compact('posts'));
    }
}
