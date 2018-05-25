<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use Carbon\Carbon;
use App\Plantilla;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
    public function index(){
        
       $posts = Post::allowed()->get();
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
            'title' => 'required|min:5'
        ]);

       // $post = Post::create( $request->only('title') );
        $post = Post::create([
            'title' => $request->get('title'),
            'user_id' => auth()->id()

        ]);

      
        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post)
    {
        if($post->user_id == auth()->user()->id)
        {
            $categories = Category::all();
            $tags = Tag::all();
            $plantillas = Plantilla::all();
            return view('admin.posts.edit', compact('post', 'categories', 'tags', 'plantillas'));
        }
        else if(auth()->user()->hasPermissionTo('Editar reportes'))
        {
            $categories = Category::all();
            $plantillas = Plantilla::all();
            $tags = Tag::all();
            return view('admin.posts.edit', compact('post', 'categories', 'tags', 'plantillas'));
        }
        else{
            abort(404);
        }

    }


    public function update(Post $post, StorePostRequest $request)
    {
   
        if(Carbon::parse($request->published_at) > today()){
            return redirect()->route('admin.posts.edit', $post)->with('error', 'La fecha no debe ser futura');
        }
        $post->update($request->all());
        $post->syncTags(request()->get('tags'));
        return redirect()->route('admin.posts.edit', $post)->with('flash', 'Reporte guardado');

    }

    public function destroy(Post $post)
    {
        if(auth()->user()->hasPermissionTo('Eliminar reportes'))
        {
            $post->delete();
            return redirect()->route('admin.posts.index')->with('flash', 'Reporte Eliminado');
        }
        else
        {
            return back()->withError('No tiene permisos');
        }
    }
}
