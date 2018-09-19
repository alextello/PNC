<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Incautacion;
use App\Post;

class IncautacionController extends Controller
{
    public function edit($id, $post)
    {
        $inc = Incautacion::find($id);
        return view('admin.incautacion.edit', compact('inc','post'));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $p = Post::find($request->post);
        $inc = Incautacion::find($id);
        $inc->descripcion = $request->descripcion;
        $inc->save();
        return redirect()->route('admin.posts.edit', $p)->withFlash('Editado!');  
    }

    public function delete($id)
    {

        $inc =  Incautacion::find($id);
        $post = Post::find(request()->post);
        $post->incautacion_id = null;
        $post->save();
        $inc->delete();
        return redirect()->back()->withFlash('Eliminado exitosamente');
    }

    public function store(Request $request)
    {
        $post = Post::find($request->post);
        $inc = new Incautacion();;
        $post->incautacion_id = Incautacion::create(['descripcion' => $request->descripcion])->id;
        $post->save();
        return back()->withFlash('Incautacion registrada');
        
    }
}
