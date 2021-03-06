<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UpdateUserRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::allowed()->latest('created_at')->withTrashed()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->hasPermissionTo('Crear Usuario'))
        {
            $user = new User;
            $roles = Role::with('permissions')->get();
            $permissions = Permission::pluck('name', 'id');
            return view('admin.users.create', compact('user', 'roles', 'permissions'));
        }
        return back()->withError('No tiene permisos');
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:4',
            'telefono' => 'required|unique:users',
            'codigo' => 'required',
            'roles' => 'required'
        ]);

        $names = explode(" ", $data['name']);
        $iniciales = [];

        foreach($names as $name)
        {
            $iniciales[] = $name[0];
        }

        $data['reference'] = implode($iniciales);

        $user =  User::create($data);
        $user->assignRole($request->roles);
        if($request->filled('permissions'))
        {
            $user->givePermissionTo($request->permissions);
        }

        return redirect()->route('admin.users.index')->withFlash('El usuario ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        $user->load(['created_by' => function($q){
            $q->take(10);
        }]);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
         $this->authorize('update', $user);
         $roles = Role::with('permissions')->get();
         $permissions = Permission::pluck('name', 'id');
         return view('admin.users.edit', compact('user', 'roles', 'permissions'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {

        $iniciales = [];
        $data = $request->validated();

        $names = explode(" ", $data['name']);
        $iniciales = [];

        foreach($names as $name)
        {
            $iniciales[] = $name[0];
        }

        $data['reference'] = implode($iniciales);

        $user->update($data);
        return back()->withFlash('Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->withFlash('Usuario eliminado');
    }

    public function restore(Request $request)
    {
        $user = User::withTrashed()->where('id', $request->user)->first();
        $user->restore();
        return redirect()->back()->withFlash('Usuario dado de alta');
    }
}
