<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GraficosController extends Controller
{
    public function rango()
    {
        return view('admin.graficos.rango');
    }

    public function comparacion()
    {
        return view('admin.graficos.comparacion');
    }

    public function rangoPost(Request $request)
    {
        $fechas = explode(' ', request()->rango);
        $fechaInicio = Carbon::createFromFormat('d/m/Y', $fechas[0]);
        $fechaFin = Carbon::createFromFormat('d/m/Y', $fechas[2]);

        $tagsP = DB::table('posts')
        ->join('tags', 'posts.tag_id', '=', 'tags.id')
        ->join('subcategories', 'subcategories.id', 'tags.subcategory_id')
        ->join('categories', 'categories.id', 'subcategories.category_id')
        ->select(DB::raw('count(tag_id) as cantidad'))
        ->where('categories.id', '1')
        ->WhereBetween('published_at', [$fechaInicio, $fechaFin])
        ->groupBy('tag_id')
        ->addSelect('tags.name', 'subcategories.name as subcategoria')
        ->orderBy('cantidad', 'desc')
        ->get();

        $tagsN = DB::table('posts')
        ->join('tags', 'posts.tag_id', '=', 'tags.id')
        ->join('subcategories', 'subcategories.id', 'tags.subcategory_id')
        ->join('categories', 'categories.id', 'subcategories.category_id')
        ->select(DB::raw('count(tag_id) as cantidad'))
        ->where('categories.id', '2')
        ->WhereBetween('published_at', [$fechaInicio, $fechaFin])
        ->groupBy('tag_id')
        ->addSelect('tags.name', 'subcategories.name as subcategoria')
        ->orderBy('cantidad', 'desc')
        ->get();

        $categorias = DB::table('posts')
        ->join('tags', 'tags.id', '=', 'posts.tag_id')
        ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
        ->join('categories', 'categories.id', '=', 'subcategories.category_id')
        ->WhereBetween('published_at', [$fechaInicio, $fechaFin])
        ->select('categories.name', DB::raw('count(subcategories.category_id) as cantidad'))
        ->groupBy('subcategories.category_id', 'categories.name')
        ->get();

        return response()->json(array(
            'tagsP' => $tagsP,
            'tagsN' => $tagsN,
            'categorias' => $categorias
        ));

    }

    public function comparacionPost(Request $request)
    {
        $fechas1 = explode(' ', request()->rango1);
        $fechaInicio1 = Carbon::createFromFormat('d/m/Y',$fechas1[0]);
        $fechaFin1 = Carbon::createFromFormat('d/m/Y',$fechas1[2]);
        
        $fechas2 = explode(' ', request()->rango2);
        $fechaInicio2 = Carbon::createFromFormat('d/m/Y',$fechas2[0]);
        $fechaFin2 = Carbon::createFromFormat('d/m/Y',$fechas2[2]);

        $categorias1 = DB::table('posts')
        ->join('tags', 'tags.id', '=', 'posts.tag_id')
        ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
        ->join('categories', 'categories.id', '=', 'subcategories.category_id')
        ->WhereBetween('published_at', [$fechaInicio1, $fechaFin1])
        ->select('categories.name', DB::raw('count(subcategories.category_id) as cantidad'))
        ->groupBy('subcategories.category_id', 'categories.name')
        ->get();

        $categorias2 = DB::table('posts')
        ->join('tags', 'tags.id', '=', 'posts.tag_id')
        ->join('subcategories', 'subcategories.id', '=', 'tags.subcategory_id')
        ->join('categories', 'categories.id', '=', 'subcategories.category_id')
        ->WhereBetween('published_at', [$fechaInicio2, $fechaFin2])
        ->select('categories.name', DB::raw('count(subcategories.category_id) as cantidad'))
        ->groupBy('subcategories.category_id', 'categories.name')
        ->get();

        $tagsP1 = DB::table('posts')
        ->join('tags', 'posts.tag_id', '=', 'tags.id')
        ->join('subcategories', 'subcategories.id', 'tags.subcategory_id')
        ->join('categories', 'categories.id', 'subcategories.category_id')
        ->select(DB::raw('count(tag_id) as cantidad'))
        ->where('categories.id', '1')
        ->WhereBetween('published_at', [$fechaInicio1, $fechaFin1])
        ->groupBy('tag_id')
        ->addSelect('tags.name', 'subcategories.name as subcategoria')
        ->orderBy('cantidad', 'desc')
        ->get();

        $tagsN1 = DB::table('posts')
        ->join('tags', 'posts.tag_id', '=', 'tags.id')
        ->join('subcategories', 'subcategories.id', 'tags.subcategory_id')
        ->join('categories', 'categories.id', 'subcategories.category_id')
        ->select(DB::raw('count(tag_id) as cantidad'))
        ->where('categories.id', '2')
        ->WhereBetween('published_at', [$fechaInicio1, $fechaFin1])
        ->groupBy('tag_id')
        ->addSelect('tags.name', 'subcategories.name as subcategoria')
        ->orderBy('cantidad', 'desc')
        ->get();

        $tagsP2 = DB::table('posts')
        ->join('tags', 'posts.tag_id', '=', 'tags.id')
        ->join('subcategories', 'subcategories.id', 'tags.subcategory_id')
        ->join('categories', 'categories.id', 'subcategories.category_id')
        ->select(DB::raw('count(tag_id) as cantidad'))
        ->where('categories.id', '1')
        ->WhereBetween('published_at', [$fechaInicio2, $fechaFin2])
        ->groupBy('tag_id')
        ->addSelect('tags.name as name', 'subcategories.name as subcategoria')
        ->orderBy('cantidad', 'desc')
        ->get();

        $tagsN2 = DB::table('posts')
        ->join('tags', 'posts.tag_id', '=', 'tags.id')
        ->join('subcategories', 'subcategories.id', 'tags.subcategory_id')
        ->join('categories', 'categories.id', 'subcategories.category_id')
        ->select(DB::raw('count(tag_id) as cantidad'))
        ->where('categories.id', '2')
        ->WhereBetween('published_at', [$fechaInicio2, $fechaFin2])
        ->groupBy('tag_id')
        ->addSelect('tags.name', 'subcategories.name as subcategoria')
        ->orderBy('cantidad', 'desc')
        ->get();

        $tagsPC1 = collect();
        $tagsPC2 = collect();

        foreach($tagsP1 as $t)
        {
            $tagsPC1[$t->subcategoria.' '.$t->name] = collect(['name' => $t->subcategoria.' '.$t->name, 'cantidad' => $t->cantidad]);
        }

        foreach($tagsP2 as $t)
        {
            if(!isset($tagsPC1[$t->subcategoria.' '.$t->name]))
            {
                $tagsPC1[$t->subcategoria.' '.$t->name] = collect(['name' => $t->subcategoria.' '.$t->name, 'cantidad' => '0']);
            }
        }

        foreach($tagsP2 as $t)
        {
            $tagsPC2[$t->subcategoria.' '.$t->name] = collect(['name' => $t->subcategoria.' '.$t->name, 'cantidad' => $t->cantidad]);
        }

        foreach($tagsP1 as $t)
        {
            if(!isset($tagsPC2[$t->subcategoria.' '.$t->name]))
            {
                $tagsPC2[$t->subcategoria.' '.$t->name] = collect(['name' => $t->subcategoria.' '.$t->name, 'cantidad' => '0']);
            }
        }

        //TAGS NEGATIVOS

        $tagsPN1 = collect();
        $tagsPN2 = collect();

        foreach($tagsN1 as $t)
        {
            $tagsPN1[$t->subcategoria.' '.$t->name] = collect(['name' => $t->subcategoria.' '.$t->name, 'cantidad' => $t->cantidad]);
        }

        foreach($tagsN2 as $t)
        {
            if(!isset($tagsPN1[$t->subcategoria.' '.$t->name]))
            {
                $tagsPN1[$t->subcategoria.' '.$t->name] = collect(['name' => $t->subcategoria.' '.$t->name, 'cantidad' => 0]);
            }
        }

        foreach($tagsN2 as $t)
        {
            $tagsPN2[$t->subcategoria.' '.$t->name] = collect(['name' => $t->subcategoria.' '.$t->name, 'cantidad' => $t->cantidad]);
        }

        foreach($tagsN1 as $t)
        {
            if(!isset($tagsPN2[$t->subcategoria.' '.$t->name]))
            {
                $tagsPN2[$t->subcategoria.' '.$t->name] = collect(['name' => $t->subcategoria.' '.$t->name, 'cantidad' => 0]);
            }
        }

        $tagsPN1 = $tagsPN1->sortKeys();
        $tagsPN2 = $tagsPN2->sortKeys();

        $tagsPC1 = $tagsPC1->sortKeys();
        $tagsPC2 = $tagsPC2->sortKeys();
      


        return response()->json([
            'cat1' => $categorias1,
            'cat2' => $categorias2,
            'fecha1' => $fechaInicio1->year,
            'fecha2' => $fechaInicio2->year,
            'tagsPC1' => $tagsPC1,
            'tagsPC2' => $tagsPC2,
            'tagsPN1' => $tagsPN1,
            'tagsPN2' => $tagsPN2,
            // 'tagasN' => $tagsN
        ]);
    }
}

