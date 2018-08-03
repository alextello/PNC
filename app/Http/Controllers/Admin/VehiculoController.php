<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vehiculo;
use App\Movil;
use App\Marca;

class VehiculoController extends Controller
{
    public function edit($id)
    {
        $vehiculo = Vehiculo::with(['brand', 'tipo'])->find($id);
        $tipos = Movil::all();
        $marcas = Marca::all();
        return view('admin.vehiculos.edit', compact('vehiculo', 'tipos', 'marcas'));
    }

    public function update($id, Request $request)
    {
        $vehiculo = Vehiculo::find($id);
        $tipo = $vehiculo->syncTipo($request->tipo);  
        $marca = $vehiculo->syncMarca($request->marca);      
        $vehiculo->placa = $request->placa;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->color = $request->color;
        $vehiculo->tipo_id = $tipo;
        $vehiculo->marca_id = $marca;
        $vehiculo->save();
        return redirect()->back()->withFlash('Editado exitosamente');        
    }

    public function delete($id)
    {
        $vehiculo =  Vehiculo::find($id);
        $vehiculo->delete();
        return redirect()->back()->withFlash('Eliminado exitosamente');
    }

    public function store(Request $request)
    {
        if(!isset($request->tipo))
        {
            return back()->withError('Seleccione el tipo de vehiculo');
        }
        else
        {
            $vehiculo = new Vehiculo();
            if(isset($request->tipo))
            $tipo = $vehiculo->syncTipo($request->tipo);
            if(isset($request->marca))
            $marca = $vehiculo->syncMarca($request->marca);
            $vehiculo->tipo_id = $tipo;
            $vehiculo->marca_id = $marca;
            $vehiculo->placa = $request->placa;
            $vehiculo->modelo = $request->modelo;
            $vehiculo->color = $request->color;
            return back()->withFlash('Vehiculo registrado');
        }
    }


}
