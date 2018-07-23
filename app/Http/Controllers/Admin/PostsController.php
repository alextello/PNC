<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\Address;
use App\Category;
use App\Gang;
use App\Municipio;
use App\Plantilla;
use App\Involucrado;
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
        $post = Post::where('url', $id)->with(['address', 'tags', 'involucrados', 'photos'])->first();
        if($post && $post->user_id == auth()->user()->id || auth()->user()->hasPermissionTo('Editar reportes'))
        {
            $municipios = Municipio::all();
            $categories = Category::with('subcategories')->get();
            $tags = Tag::all();
            $gangs = Gang::all();
            $plantillas = Plantilla::all();
            return view('admin.posts.edit', compact('post', 'categories', 'tags', 'plantillas', 'municipios', 'gangs'));
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
        $request->merge(['address_id' => Address::create(['name' => $request->address_id, 'municipio_id' => $request->municipio])->id]);
        $post->update($request->all());
        $post->syncInvolucrados(request()->get('involucrados'),request()->get('dpi'),request()->get('genero'), $request);
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
        $involucrado = Involucrado::find($id);
        return view('admin.involucrados.index', compact('involucrado', 'gangs', 'post'));
    }

    public function involucradoUpdate($id, $post, Request $request)
    {   
        if(isset($request->dpi))
        {
            $involucrado = Involucrado::where('dpi', $request->dpi)->first();
            if(!$involucrado){
                $involucrado = Involucrado::find($id)->first();    
            }
        }
        else 
        {
            $involucrado = Involucrado::find($id)->first();
        }
        $item = Gang::where('id', $request->gang_id)->first();
        
        // $this->validate($request, [
        //     'age_id' => 'required',
        //     'name' => 'required'
        // ]);
            // dd($request);
        if(isset($item))
        {
            $involucrado->name = $request->name;
            $involucrado->dpi = $request->dpi;
            $involucrado->gang_id = $request->gang_id;
            $involucrado->tattoos = $request->tattoos;
            $involucrado->alias = $request->alias;
            $involucrado->gender = $request->gender;
            $involucrado->age = $request->age;
            $involucrado->save();
        }
        else
        {
            $gang = Gang::create(['name' => $request->gang_id])->id;
            $request->merge(['gang_id' => $gang]);
            $involucrado->name = $request->name;
            $involucrado->dpi = $request->dpi;
            $involucrado->gang_id = $request->gang_id;
            $involucrado->tattoos = $request->tattoos;
            $involucrado->alias = $request->alias;
            $involucrado->gender = $request->gender;
            $involucrado->age = $request->age;
            $involucrado->save();

        }
        $p = Post::find($post);
        return redirect()->route('admin.posts.edit', $p);
    }
}
