<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Robo;
use App\Post;

class RoboController extends Controller
{
    public function edit($id, $post)
    {
        $inc = Robo::find($id);
        return view('admin.robo.edit', compact('inc','post'));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $inc = Robo::find($id);
        $p = Post::find($request->post);
        $inc->descripcion = $request->descripcion;
        $inc->save();
        return redirect()->route('admin.posts.edit', $p)->withFlash('Editado!');   
    }

    public function delete($id)
    {

        $inc =  Robo::find($id);
        $post = Post::find(request()->post);
        $post->robo_id = null;
        $post->save();
        $inc->delete();
        return redirect()->back()->withFlash('Eliminado exitosamente');
    }

    public function store(Request $request)
    {
        $post = Post::find($request->post);
        $inc = new Robo();;
        $post->robo_id = Robo::create(['descripcion' => $request->descripcion])->id;
        $post->save();
        return back()->withFlash('Incautacion registrada');
        
    }
}
