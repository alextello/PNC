<?php

namespace App\Http\Controllers\Admin;

use App\Headers;
use App\Plantilla;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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

    public function header()
    {
        $head = Headers::first();
        return view('admin.plantillas.header-edit', compact('head'));
    }

    public function footer()
    {
        $head = Headers::first();
        return view('admin.plantillas.footer-edit', compact('head'));
    }
  
    public function storageHeader(Request $request)
    {
        // dd('hola');
        Storage::disk('public')->delete(['banner/header.jpeg','banner/header.jpg','banner/header.png' ]);
        $head = Headers::first();
        $ext = $request->file('photo')->extension();
        $img = $request->file('photo')->storeAs('banner', 'header.'.$ext, 'public');
        $head->header = $img;
        $head->save();
        return redirect()->route('admin.plantillas.header');
    }

    public function headerDefault(Request $request)
    {
        $header = Headers::first();

        if($request->encabezado === 'defecto')
        {
            $header->default_header = 1;
        }
        else{
            $header->default_header = 0;
        }
        $header->save();

        return redirect()->route('admin.plantillas.header');
    }

    public function storageFooter(Request $request)
    {
        Storage::disk('public')->delete(['banner/footer1.jpeg','banner/footer1.jpg','banner/footer1.png' ]);
        $head = Headers::first();
        $ext = $request->file('photo')->extension();
        $img = $request->file('photo')->storeAs('banner', 'footer1.'.$ext, 'public');
        $head->footer = $img;
        $head->save();
        return redirect()->route('admin.plantillas.footer');
    }

    public function footerDefault(Request $request)
    {
        $header = Headers::first();

        if($request->footer === 'defecto')
        {
            $header->default_footer = 1;
        }
        else{
            $header->default_footer = 0;
        }
        $header->save();

        return redirect()->route('admin.plantillas.footer');
    }
}
