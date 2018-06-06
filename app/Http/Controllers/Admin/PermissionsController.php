<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view', new Permission);
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

   
    public function edit(Permission $permission)
    {
        $this->authorize('update', $permission);
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->authorize('update', $permission);
        $data = $request->validate([
            'display_name' => 'required'
        ]);

        $permission->update($data);

        return redirect()->route('admin.permissions.edit', $permission)->withFlash('Permiso editado correctamente');
    }

 
}
