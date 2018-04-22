<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }
}
