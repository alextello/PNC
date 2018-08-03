<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\Address;
use App\Category;
use App\Gang;
use App\Municipio;
use App\Aldea;
use App\User;
use App\Marca;
use App\Movil;
use App\Vehiculo;
use App\Plantilla;
use App\Involucrado;
use App\Delito;
use Carbon\Carbon;
use App\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::with('owner', 'tags')->allowed()->latest('published_at')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        if(auth()->user()->hasPermissionTo('Crear reportes'))
        {

            $this->validate($request, [
                'title' => 'required|min:5'
            ]);
    
           // $post = Post::create( $request->only('title') );
            $post = Post::create([
                'title' => $request->get('title'),
                'user_id' => auth()->id()
    
            ]);
    
            return redirect()->route('admin.posts.edit', $post);
        }
        else
        {
            return redirect()->route('dashboard', '#error')->withError('No tiene permiso');
        }
    }

    public function edit($id)
    {
    $post = Post::where('url', $id)->with(['address', 'tags', 'photos', 'delito'])->with(['involucrados' => function($q){
        $q->with(['mara', 'movil']);
        }])->with(['vehiculo' => function ($v){
            $v->with(['brand', 'tipo']);
        }])->first();
        if($post && $post->user_id == auth()->user()->id || auth()->user()->hasPermissionTo('Editar reportes'))
        {
            $aldeas = Aldea::all();
            $delitos = Delito::all();
            $movil = Movil::all();
            $marca = Marca::all();
            $users = User::with('procesos')->get();
            $unidades = Vehiculo::with('procesos')->where('tipo_id', '1')->get();
            $categories = Category::with('subcategories')->get();
            $tags = Tag::all();
            $gangs = Gang::all();
            $plantillas = Plantilla::all();
            return view('admin.posts.edit', compact('post', 'users', 'unidades', 'categories', 'tags', 'marca', 'plantillas', 'aldeas', 'gangs', 'movil', 'delitos'));
        }
       
        else{
            abort(404);
        }

    }


    public function update(Post $post, StorePostRequest $request)
    {
        // if(Carbon::parse($request->published_at) > today()){
        //     return redirect()->route('admin.posts.edit', $post)->with('error', 'La fecha no debe ser futura');
        // }
        // $post->involucrados()->detach();
        // dd($request->all());
        // dd($request->all());
        $request->merge(['time' => date("H:i", strtotime($request->time))]);
        $request->merge(['address_id' => Address::create(['name' => $request->address_id, 'aldea_id' => $request->aldea])->id]);
        if($request->delito_id)
        $request->merge(['delito_id' => $post->syncDelitos($request->delito_id)]);
        $post->update($request->all());
        $post->syncInvolucrados(request()->get('involucrados'),request()->get('dpi'),request()->get('genero'), $request);
        if(isset($request->unidades))
        $post->syncUnidades($request->unidades);
        else
        $post->unidades()->detach();
        if(isset($request->agentes))
        $post->syncAgentes($request->agentes);
        else
        $post->proceden()->detach();
        return redirect()->route('admin.posts.edit', $post)->with('flash', 'Reporte guardado');

    }

    public function destroy(Post $post)
    {
        if(auth()->user()->hasPermissionTo('Eliminar reportes') || auth()->user->hasRole('Administrador'))
        {
            $post->delete();
            return redirect()->route('admin.posts.index')->with('flash', 'Reporte Eliminado');
        }
        else
        {
            return back()->withError('No tiene permisos');
        }
    }

    public function involucrado($id, $post)
    {   
        $gangs = Gang::all();
        $movil = Movil::all();
        $involucrado = Involucrado::find($id);
        if($involucrado->aprehendido == '1')
        return view('admin.involucrados.index', compact('involucrado', 'gangs', 'post', 'movil'));
        else
        return view('admin.involucrados.fallecido', compact('involucrado', 'gangs', 'post', 'movil'));
    }

    public function involucradoUpdate($id, $post, Request $request)
    {   
         
        $involucrado = Involucrado::find($id)->first();
        $p = Post::find($post);
        $gangID = (Int) $p->syncGangs([$request->gang_id])[0];

        if($involucrado->aprehendido == '0')
        {
            $this->validate($request, [
                'herido' => 'required'
            ]);
            $abordo = (Int) $p->syncAbordo($request->abordo);
            $involucrado->name = $request->herido;
            $involucrado->dpi = $request->dpiherido;
            $involucrado->gender = $request->generoherido;
            $involucrado->age = $request->ageherido;
            $involucrado->tattoos = $request->tattoosherido;
            $involucrado->alias = $request->aliasherido;
            $involucrado->gang_id = $gangID;
            $involucrado->movil_id = $abordo;
            $involucrado->heridas = $request->heridas;
            $involucrado->motivo = $request->motivo;
            $involucrado->diagnostico = $request->diagnostico;
            $involucrado->observaciones = $request->observaciones;
            $involucrado->save();
        }
        else
        {
            $this->validate($request, [
                'name' => 'required',
            ]);
            $involucrado->name = $request->name;
            $involucrado->dpi = $request->dpi;
            $involucrado->gender = $request->gender;
            $involucrado->age = $request->age;
            $involucrado->tattoos = $request->tattoos;
            $involucrado->alias = $request->alias;
            $involucrado->gang_id = $gangID;
            $involucrado->save();
        }
        return redirect()->route('admin.posts.edit', $p);
    }
}
