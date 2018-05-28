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
        return view('admin.roles.create', ['permissions' => Permission::pluck('name', 'id'), 'role' => new Role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->permissions;
        if($request->filled('permissions'))
        {
            $data = $request->validate([
                'name' => 'required|unique:roles',
                'display_name' => 'required|unique:roles'
            ]);
            dd($data);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
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
        if($request->filled('permissions'))
        {
            $data = $request->validate([
                'display_name' => 'required|unique:roles,display_name,' . $role->id,
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
    public function destroy($id)
    {
        //
    }
}
