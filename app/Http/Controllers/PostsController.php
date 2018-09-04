<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        
        if($post->isPublished() || auth()->check())
        {
            $post->load(['owner', 'photos'])->load(['address' => function($q){
                $q->with('aldea');
            }])
            ->load(['tags' => function($q){
                $q->with(['subcategory' => function($q){
                    $q->with('category');
                }]);
            }])->first();
            
            if(request()->wantsJson())
            return $post;
            else
            return view('posts.show', compact('post'));
        }
        abort(404);
    }

}
