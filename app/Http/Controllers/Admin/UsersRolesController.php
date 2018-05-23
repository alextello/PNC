<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersRolesController extends Controller
{
 
    public function update(Request $request, User $user)
    {
        if($request->filled('roles'))
        {
            $user->syncRoles($request->roles);
            return redirect('admin/users')->withFlash('Los roles han sido actualizados');
        }
        else
        {
            return back()->withError('No se puede quedar sin roles');
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
