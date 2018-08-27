<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Marca;
use App\Type;
use App\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class VehiculoController extends Controller
{
    public function edit($id)
    {
        $vehiculo = Vehiculo::with(['brand', 'tipo'])->find($id);
        $tipos = Type::where('modelo', 'App\Vehiculo')->get();
        $marcas = Marca::all();
        return view('admin.vehiculos.edit', compact('vehiculo', 'tipos', 'marcas'));
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $vehiculo = Vehiculo::find($id);
        $tipo = $vehiculo->syncTipo($request->type_id);  
        $marca = $vehiculo->syncMarca($request->marca_id);      
        $vehiculo->placa = $request->placa;
        $vehiculo->linea = $request->linea ? $request->linea : 'IGN';
        $vehiculo->modelo = $request->modelo;
        $vehiculo->color = $request->color;
        $vehiculo->type_id = $tipo;
        $vehiculo->marca_id = $marca;
        $vehiculo->save();
        return redirect()->back()->withFlash('Editado exitosamente');        
    }

    public function delete($id)
    {

        $vehiculo =  Vehiculo::find($id);
        $post = Post::find(request()->post);
        $post->vehiculo_id = null;
        $post->save();
        $vehiculo->delete();
        return redirect()->back()->withFlash('Eliminado exitosamente');
    }

    public function store(Request $request)
    {
        $post = Post::find($request->post);
        $vehiculo = new vehiculo();
        $request->merge(['type_id' => $vehiculo->syncTipo($request->type_id)]);
        $request->merge(['marca_id' => $vehiculo->syncMarca($request->marca_id)]);
        $post->vehiculo_id = Vehiculo::create($request->all())->id;
        $post->save();
        return back()->withFlash('Vehiculo registrado');
        
    }


}
