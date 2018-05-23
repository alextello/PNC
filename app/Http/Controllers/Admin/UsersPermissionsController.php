<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersPermissionsController extends Controller
{
    public function update(Request $request, User $user)
    {
        $user->permissions()->detach();
        if($request->filled('permissions'))
        {
            $user->givePermissionTo($request->permissions);
        }
        return back()->withFlash('Los permisos se han actualizado');
    }
}
