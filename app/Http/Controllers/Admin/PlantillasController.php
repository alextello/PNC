<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plantilla;

class PlantillasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blades = Plantilla::allowed()->get();
        return view('admin.plantillas.index', compact('blades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->hasPermissionTo('Crear plantilla'))
        {
            return view('admin.plantillas.create');
        }
        else
        {
            return back()->withError('No tiene permiso');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:plantillas',
            'body' => 'required'
        ]);

        Plantilla::create($data);
        return redirect()->route('admin.plantillas.index')->withFlash('Plantilla creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Plantilla $plantilla)
    {
        if(auth()->user()->hasPermissionTo('Ver plantilla'))
        {
            return view('admin.plantillas.show', compact('plantilla'));
        }
        else
        {
            return back()->withError('No tiene permiso');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Plantilla $plantilla)
    {
        if(auth()->user()->hasPermissionTo('Editar plantilla'))
        {
            return view('admin.plantillas.edit', compact('plantilla'));
        }
        else
        {
            return back()->withError('No tiene permiso');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plantilla $plantilla)
    {
        if(auth()->user()->hasPermissionTo('Editar plantilla'))
        {
            $plantilla->update($request->all());
            return back()->withFlash('Plantilla Editada');
        }
        else
        {
            return back()->withError('No tiene permiso');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plantilla $plantilla)
    {
        if(auth()->user()->hasPermissionTo('Eliminar plantilla'))
        {
            $plantilla->delete();
            return back()->withFlash('Plantilla eliminada');
        }
        else
        {
            return back()->withError('No tiene permiso');
        }
    }
}
