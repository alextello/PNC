<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new Role);
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', $role = new Role);
        return view('admin.roles.create', ['permissions' => Permission::pluck('name', 'id'), 'role' => $role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Role);
        //return $request->permissions;
        if($request->filled('permissions'))
        {
            $data = $request->validate([
                'name' => 'required|unique:roles',
                'display_name' => 'required|unique:roles'
            ],
            [

                'name.required' => 'El campo nombre es obligatorio',
                'name.unique' => 'El campo nombre ya ha sido registrado',
                'display_name.required' => 'El campo identificador es obligatorio',
                'display_name.unique' => 'El campo identificador ya ha sido registrado',

            ]);

            $role = Role::create([
                'name' => $data['name'],
                'guard_name' => 'web',
                'display_name' => $data['display_name']
            ]);
            $role->givePermissionTo($request->permissions);

            return redirect()->route('admin.roles.index')->withFlash('Role creado');
        }
        else
        {
            return back()->withError('Debe darle permisos al rol');
        }
    }

 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);
        return view('admin.roles.edit', ['permissions' => Permission::pluck('name', 'id'), 'role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);
        if($request->filled('permissions'))
        {
            $data = $request->validate([
                'display_name' => 'required|unique:roles,display_name,' . $role->id,
            ],
            [
                'display_name.required' => 'El campo nombre es obligatorio',
                'display_name.unique' => 'El campo nombre ya ha sido registrado',
            ]);
            $role->update($data);
            $role->permissions()->detach();
            $role->givePermissionTo($request->permissions);
            return redirect()->route('admin.roles.edit', $role)->withFlash('El rol ha sido actualizado correctamente');
        }
        else
        {
            return back()->withError('El rol debe tener algún permiso');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        
        $this->authorize('delete', $role);
        $role->delete();
        return redirect()->route('admin.roles.index')->withFlash('Role eliminado correctamente');
        
    }
}