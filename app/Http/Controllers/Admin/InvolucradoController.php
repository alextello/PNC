<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Involucrado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvolucradoController extends Controller
{
    public function destroy($id, $postid)
    {
        $inv = Involucrado::find($id);
        $inv->posts()->detach($postid);
        if($inv->posts()->count() == 0){
            $inv->delete();
        }
        return back();
    }

    public function fallecidos(Request $request)
    {   
        if(!isset($request->herido))
        return back()->withError('Nombre requerido para el fallecido/herido');
        else
        {
            $p = Post::find($request->post);
            $gangID = (Int) $p->syncGangs([$request->gangherido])[0];
            if(!isset($request->abordo))
            $abordo = 3;
            else
            $abordo = (Int) $p->syncAbordo($request->abordo);
            $involucrado = new Involucrado();
            $involucrado->name = $request->herido;
            $involucrado->dpi = $request->dpiherido;
            $involucrado->gender = $request->generoherido;
            $involucrado->age = $request->ageherido;
            $involucrado->tattoos = $request->tattoosherido;
            $involucrado->alias = $request->aliasherido;
            $involucrado->gang_id = $gangID;
            $involucrado->movil_id = $abordo;
            $involucrado->aprehendido = '0';
            $involucrado->heridas = $request->heridas;
            $involucrado->motivo = $request->motivo;
            $involucrado->diagnostico = $request->diagnostico;
            $involucrado->observaciones = $request->observaciones;
            $involucrado->save();
            $p->involucrados()->attach($involucrado->id);

        }
        return redirect()->route('admin.posts.edit', ['post' => $p]);
    }

    public function vehiculos(Request $request)
    {
        
    }
}
