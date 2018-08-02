<?php

namespace App;

use Carbon\Carbon;
use App\Involucrado;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'delito_id',
        'published_at',
        'category_id',
        'user_id',
        'subcategory_id',
        'time',
        'tag_id',
        'address_id',
        'oficio'
    ];

    protected $dates = ['published_at'];

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    public function proceden()
    {
        return $this->belongsToMany('App\User');
    }

    public function unidades()
    {
        return $this->belongsToMany('App\Vehiculo');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    public function tags()
    {
        return $this->belongsTo('App\Tag', 'tag_id');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function involucrados()
    {
        return $this->belongsToMany('App\Involucrado');
    }

    public function delito()
    {
        return $this->belongsTo('App\Delito');
    }

    public static function create(array $attributes = [])
    {
        $post = static::query()->create($attributes);
        $post->generarUrl();
        return $post;
    }

    public function generarUrl()
    {
        $url = str_slug($this->title);
        if($this->whereUrl($url)->exists()){ 
            $url = "{$url}-{$this->id}";
        }
        $this->url = $url;
        $this->save();
    }

    public function isPublished()
    {
        return (bool) $this->published_at;
    }

    public function setCategoryIdAttribute($category)
    {
        $this->attributes['category_id'] = Category::find($category) ? $category : Category::create(['name' => $category])->id;
    }

    public function setPublishedAtAttribute($published_at)
    {
        $this->attributes['published_at'] = Carbon::parse($published_at)->hour(0);
    }

    // public function syncTags($tag)
    // {
    //     $tagIds = collect($tag)->map(function($tag){
    //         return Tag::find($tag) ? $tag : Tag::create([ 'name' => $tag])->id;
    //     });

    //     return $this->tags()->sync($tagIds);
    // }

    public function syncInvolucrados($involucrado, $dpi, $genero, $request)
    {
        
        if(isset($request->gang))
        {
            $gangs = $this->syncGangs($request->gang);
        }
        else
        {
            $gangs[]=0;
        }

        $coleccion = collect();
        $i = 0;
        $involucrado = collect($involucrado);
        foreach($involucrado as $in)
        {
            $coleccion->push(['name' => $involucrado[$i], 'dpi' => $dpi[$i], 'gender' => $genero[$i], 'gang_id' => $gangs[$i], 'alias' => $request->alias[$i], 'tattoos' => $request->tattoos[$i], 'age'=>$request->age[$i] ]);
            $i++;
        }
        $i = 0;
   
        foreach($coleccion as $col)
        {
            if(!isset($col['name']))
            {
                $coleccion->forget([$i]);
            }
            $i++;
        }
        
        $in = [];
        foreach($coleccion as $col)
        {
            if(isset($col['dpi']))
            $found = Involucrado::where('dpi', $col['dpi'])->first();
            else
            $found = Involucrado::where('name', $col['name'])->first();
            $in[] = $found ? $found->id : Involucrado::create($col)->id;
        }

        return $this->involucrados()->attach($in);

    }

    public function syncGangs($gangs)
    {
        $gangsID = collect();
        foreach($gangs as $gang)
        {
             if($item = Gang::where('name', $gang)->first())
            {
                $gangsID->push($item->id); 
            }
            else
            {
                $gangsID->push( Gang::create(['name' => $gang])->id );
            }
        }
        return $gangsID;
    }

    public function syncDelitos($delito)
    {
        $query = Delito::where('name', $delito)->first();
        $delito =  $query ? $query->id : Delito::create(['name' => $delito ])->id;
        return $delito;
    }

    public function syncAbordo($abordo)
    {
        $query = Movil::where('id', $abordo)->first();
        $abordo =  $query ? $query->id : Movil::create(['tipo' => $abordo ])->id;
        return $abordo;
    }
    
    public function scopeAllowed($query)
    {
        if(auth()->user()->hasPermissionTo('Ver reportes'))
        {
            return $query;
        }
        else
        {
             return $query->where('user_id', auth()->id());
        }
    }

    public function syncUnidades($unidades)
    {
        $ids = [];
        foreach($unidades as $unidad)
        {
            $query = Vehiculo::where('placa', $unidad)->first();
            $ids[] = $query ? $query->id : Vehiculo::create(['placa' => $unidad, 'tipo_id' => '1'])->id;
        }
        $this->unidades()->sync($ids);
    }

    public function syncAgentes($agentes)
    {
        $this->proceden()->sync($agentes);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::deleting(function($post){
            // $post->tags()->detach();
            $post->involucrados()->detach();
            $post->photos->each->delete();
        });
    }


}
