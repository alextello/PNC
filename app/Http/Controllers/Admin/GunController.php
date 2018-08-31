<?php

namespace App\Http\Controllers\Admin;

use App\Gun;
use App\Post;
use App\Type;
use App\Marca;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GunController extends Controller
{
    public function edit($id)
    {
        $gun = Gun::with(['brand', 'tipo'])->find($id);
        $tipos = Type::where('modelo', 'App\Gun')->get();
        $marcas = Marca::where('modelo', 'App\Gun')->get();
        return view('admin.guns.edit', compact('gun', 'tipos', 'marcas'));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $gun = Gun::find($id);
        $tipo = $gun->syncTipo($request->type_id);  
        $marca = $gun->syncMarca($request->marca_id);      
        $gun->type_id = $tipo;
        $gun->marca_id = $marca;
        $gun->registro = $request->registro ? $request->registro : 'IGN';
        $gun->licencia = $request->licencia ? $request->licencia : 'IGN';
        $gun->calibre = $request->calibre ? $request->calibre : 'IGN';
        $gun->recuperada_por = $request->recuperada_por;
        $gun->save();
        return redirect()->back()->withFlash('Editado exitosamente');        
    }

    public function delete($id)
    {

        $gun =  Gun::find($id);
        $post = Post::find(request()->post);
        $post->gun_id = null;
        $post->save();
        $gun->delete();
        return redirect()->back()->withFlash('Eliminado exitosamente');
    }

    public function store(Request $request)
    {
        $post = Post::find($request->post);
        $gun = new Gun();
        $request->merge(['type_id' => $gun->syncTipo($request->type_id)]);
        $request->merge(['marca_id' => $gun->syncMarca($request->marca_id)]);
        $post->gun_id = Gun::create($request->all())->id;
        $post->save();
        return back()->withFlash('Arma registrada');
        
    }

}
