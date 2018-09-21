<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Gang;
use App\Post;
use App\User;
use App\Aldea;
use App\Marca;
use App\Type;
use App\Address;
use App\Offense;
use App\Category;
use App\Typology;
use App\Vehiculo;
use App\Municipio;
use App\Plantilla;
use Carbon\Carbon;
use App\Involucrado;
use App\Subcategory;
use App\ModusOperandi;
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

        $post = Post::where('url', $id)->with(['address', 'tags', 'photos', 'modusoperandi', 'typology', 'incautacion', 'robo'])->with(['involucrados' => function($q){
        $q->with(['mara', 'movil', 'delito']);
        }])->with(['vehiculo' => function ($v){
            $v->with(['brand', 'tipo']);
        }])->with(['arma' => function($f){
            $f->with(['brand', 'tipo']);
        }])->first();
        // dd($post);
        if($post && ($post->user_id == auth()->user()->id) || auth()->user()->hasPermissionTo('Editar reportes'))
        {
            $aldeas = Aldea::all();
            $typeA = Type::where('modelo', 'App\Gun')->get();
            $typeV = Type::where('modelo', 'App\Vehiculo')->get();
            $marcaV = Marca::where('modelo', 'App\Vehiculo')->get();
            $marcaA = Marca::where('modelo', 'App\Gun')->get();
            $modus = ModusOperandi::all();
            $typology = Typology::all();
            $users = User::with('procesos')->get();
            $unidades = Vehiculo::with('procesos')->where('type_id', '1')->get();
            $categories = Category::with('subcategories')->get();
            $tags = Tag::with('subcategory')->get();
            $offense = Offense::all();
            $gangs = Gang::all();
            $plantillas = Plantilla::all();
            return view('admin.posts.edit', compact('post', 'users', 'unidades', 'categories', 'tags', 'marcaV', 'marcaA', 'plantillas', 'aldeas', 'gangs', 'typeA', 'typeV', 'modus', 'typology', 'offense'));
        }
        else{
            abort(404);
        }

    }


    public function update(Post $post, StorePostRequest $request)
    {
        // dd($request->published_at);
        // if(Carbon::parse($request->published_at) > today()){
        //     return redirect()->route('admin.posts.edit', $post)->with('error', 'La fecha no debe ser futura');
        // }
        // $post->involucrados()->detach();
        $request->merge(['time' => date("H:i", strtotime($request->time))]);
        $request->merge(['address_id' => Address::create(['name' => $request->address_id, 'aldea_id' => $request->aldea])->id]);
        if($request->typology_id)
        $request->merge(['typology_id' => $post->syncTypology($request->typology_id)]);
        if($request->modus_operandi_id)
        $request->merge(['modus_operandi_id' => $post->syncModusOperandi($request->modus_operandi_id)]);
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
        $typeV = Type::where('modelo', 'App\Vehiculo')->get();
        $delitos = Offense::all();
        $involucrado = Involucrado::find($id);
        if($involucrado->aprehendido == '1')
        return view('admin.involucrados.index', compact('involucrado', 'gangs', 'post', 'typeV', 'delitos'));
        else
        return view('admin.involucrados.fallecido', compact('involucrado', 'gangs', 'post', 'typeV'));
    }

    public function involucradoUpdate($id, $post, Request $request)
    {   
        //  dd($request->gangherido);
        $involucrado = Involucrado::where('id', $id)->first();
        // dd($involucrado);
        $p = Post::find($post);
        // dd($p);
        if(isset($request->gangherido))
        $gangID = (Int) $p->syncGangs([$request->gangherido])[0];
        else
        $gangID = null;
        if(isset($request->offense))
        $offense = $p->syncOffenses([$request->offense])[0];
        else
        $offense = null;

        if($involucrado->aprehendido == '0')
        {
            $this->validate($request, [
                'herido' => 'required'
            ]);
            if(isset($request->abordo))
            $abordo = (Int) $p->syncAbordo($request->abordo);
            else
            $abordo = null;
            $involucrado->name = $request->herido;
            $involucrado->dpi = $request->dpiherido;
            $involucrado->gender = $request->generoherido;
            $involucrado->age = $request->ageherido;
            $involucrado->tattoos = $request->tattoosherido;
            $involucrado->alias = $request->aliasherido;
            $involucrado->fallecido = $request->herofall;
            $involucrado->gang_id = $gangID;
            $involucrado->type_id = $abordo;
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
            $involucrado->offense_id = $offense;
            $involucrado->tattoos = $request->tattoos;
            $involucrado->alias = $request->alias;
            $involucrado->gang_id = $gangID;
            $involucrado->save();
        }
        return redirect()->route('admin.posts.edit', $p);
    }
}
