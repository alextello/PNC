<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use App\Category;
use Carbon\Carbon;
use App\Involucrado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TablasEstadisticasController extends Controller
{

    public function hechosNegativos(Request $request)
    {   
        $category = '2';

        if($request->method() == 'POST')
        $year = $request->Buscar;
        else
        $year = Carbon::now()->year;

        $tags = $this->consulta($year, $category);
        return view('admin.TablasEstadisticas.negativos', compact('tags', 'year'));
    }

    public function hechosPositivos(Request $request)
    {
        $category = '1';
        
        if($request->method() == 'POST')
        $year = $request->Buscar;
        else
        $year = Carbon::now()->year;
        
        $tags = $this->consulta($year, $category);
        return view('admin.TablasEstadisticas.positivos', compact('tags', 'year'));
    }
    public function hechosNegativosMes(Request $request)
    {
        $category = '2';
        $title = 'NEGATIVOS';
        if($request->method() == 'POST')
        {
            $date = Carbon::createFromFormat('m-Y', $request->Buscar);
            $days = $date->daysInMonth;
            $year = $date->year;
            $month = $date->month;
        }
        else
        {
            $date = Carbon::now();
            $days = $date->daysInMonth;
            $year = $date->year;
            $month = $date->month;
        }

        $tags = $this->consultaMes($days, $year, $month, $category);
        $date = $date->format('m-Y');
        return view('admin.TablasEstadisticas.negativos-mes', compact('days', 'tags', 'date'));   
    }

    public function hechosPositivosMes(Request $request)
    {
        $category = '1';
        $title = 'POSITIVOS';
        if($request->method() == 'POST')
        {
            $date = Carbon::createFromFormat('m-Y', $request->Buscar);
            $days = $date->daysInMonth;
            $year = $date->year;
            $month = $date->month;
        }
        else
        {
            $date = Carbon::now();
            $days = $date->daysInMonth;
            $year = $date->year;
            $month = $date->month;
        }

        $tags = $this->consultaMes($days, $year, $month, $category);
        $date = $date->format('m-Y');
        return view('admin.TablasEstadisticas.positivos-mes', compact('days', 'tags', 'date'));   
    }

    public function negativosTag()
    {
        $tags = DB::table('tags')
            ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
            ->where('subcategories.category_id', '=', '2')
            ->select('tags.name', 'tags.id', 'subcategories.name as subcategory')
            ->get();
        return view('admin.TablasEstadisticas.tags-index', compact('tags'));
    }

    public function positivosTag()
    {
        $tags = DB::table('tags')
            ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
            ->where('subcategories.category_id', '=', '1')
            ->select('tags.name', 'tags.id', 'subcategories.name as subcategory')
            ->get();
        return view('admin.TablasEstadisticas.tags-index', compact('tags'));
    }

    public function buscarTag(Request $request)
    {
        $tag = Tag::where('id', $request->tag)->with('subcategory')->first();

        switch($tag->subcategory->name)
        {
            case 'Detenido por':

            $posts = Post::where('tag_id', $request->tag)->with(['tags'])->with(['involucrados' => function($q){
                $q->with(['mara', 'movil']);
                }])->with(['address' => function($q){
                    $q->with(['aldea']);
                }])
                ->get();
            break;

            case 'Recuperado o incautado':


            break;

            case 'Fallecidos por':
            $posts = Post::where('tag_id', $request->tag)->with(['tags'])->with(['involucrados' => function($q){
                $q->where('involucrados.fallecido', '1')->with(['mara', 'movil']);
            }])->with(['address' => function($q){
                $q->with(['aldea']);
            }])
            ->get();

            $tag = Tag::where('id', $request->tag)->select('name')->first();
            
            return view('admin.TablasEstadisticas.tabla-fallecidos', compact('posts', 'tag'));

            break;

            case 'Heridos por':

            $posts = Post::where('tag_id', $request->tag)->with(['tags'])->with(['involucrados' => function($q){
                $q->where('involucrados.fallecido', '0')->where('aprehendido', '0')->with(['mara', 'movil']);
            }])->with(['address' => function($q){
                $q->with(['aldea']);
            }])
            ->get();

            $tag = Tag::where('id', $request->tag)->select('name')->first();
            
            return view('admin.TablasEstadisticas.tabla-heridos', compact('posts', 'tag'));

            break;

            case 'Delitos contra la libertad, seguridad y sexuales a la persona':

            break;

            case 'Hechos contra la propiedad':

            break;

            case 'Robo de vehiculos y armas':

            break;

        }

        

        //  $personas = Involucrado::with(['posts' => function($a){
        //      $a->with(['tags', 'involucrados'])->with(['address' => function($q){
        //          $q->with('aldea');
        //      }]);
        //  }])->get();

        return view('admin.TablasEstadisticas.tabla-detenidos', compact('posts'));
    }

    public function consultaMes($days, $year, $month, $category)
    {
        $query =  DB::table('posts')
        ->join('tags', 'tags.id', '=', 'posts.tag_id')
        ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
        ->select('tags.name', DB::raw('DAY(published_at) as dia'), DB::raw('count(posts.tag_id) as cantidad'))
        ->whereYear('published_at', '=', $year)
        ->whereMonth('published_at', '=', $month)
        ->where('subcategories.category_id', '=', $category)
        ->groupBy('tags.name', 'dia')
        ->orderBy('dia', 'asc')
        ->get();
        
        $tags = collect();
        $vacios = collect();

        foreach($query as $q)
        {
            $tags[$q->name] = collect(['name' => $q->name]);
            $tags[$q->name]['dias'] = collect();
        }
        $tags = $tags->unique();

        foreach($query as $q)
    {
        foreach($tags as $tag)
        {
            if($tag->contains($q->name))
            {
               $tag['dias']->put($q->dia, $q->cantidad);
            }
        }
       
    }
        $dias = collect();
        for($i = 1; $i<=$days; $i++)
        {
            $dias->put($i,0);
        }
    
        foreach($tags as $tag)
        {
            $names[] = $tag['name'];
            $tag['dias'] = $tag['dias']->union($dias);
            $tag['dias'] = $tag['dias']->sortKeys();
        }
        
        $nullTags = DB::table('tags')
        ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
        ->where('subcategories.category_id', $category)
        ->select('tags.name')
        ->get();
    
        foreach($nullTags as $null)
        {
            $vacios[$null->name] = collect(['name' => $null->name]);
            $vacios[$null->name]['dias'] = $dias;
        }
    
        $tags = $tags->union($vacios);

        return $tags;
    }

    public function consulta($year, $category)
    {
        
        $query =  DB::table('posts')
                ->join('tags', 'tags.id', '=', 'posts.tag_id')
                ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
                ->select('tags.name', DB::raw('MONTH(published_at) as mes'), DB::raw('count(posts.tag_id) as cantidad'))
                ->whereYear('published_at', '=', $year)
                ->where('subcategories.category_id', '=', $category)
                ->groupBy('tags.name', 'mes')
                ->orderBy('mes', 'asc')
                ->get();
        
        $tags = collect();
        $vacios = collect();

        foreach($query as $q)
        {
            $tags[$q->name] = collect(['name' => $q->name]);
            $tags[$q->name]['meses'] = collect();
        }
        
        $tags = $tags->unique();
        foreach($query as $q)
        {
            foreach($tags as $tag)
            {
                if($tag->contains($q->name))
                {
                   $tag['meses']->put($q->mes, $q->cantidad);
                }
            }
           
        }
        
        $meses = collect([1 => 0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0, 12=>0]);

        foreach($tags as $tag)
        {
            $names[] = $tag['name'];
            $tag['meses'] = $tag['meses']->union($meses);
            $tag['meses'] = $tag['meses']->sortKeys();
        }
        
        $nullTags = DB::table('tags')
        ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
        ->where('subcategories.category_id', '2')
        ->select('tags.name')
        ->get();

        foreach($nullTags as $null)
        {
            $vacios[$null->name] = collect(['name' => $null->name]);
            $vacios[$null->name]['meses'] = $meses;
        }

        $tags = $tags->union($vacios);
        return $tags;

    }

}
