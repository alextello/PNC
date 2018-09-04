<?php

namespace App;

use App\Offense;
use App\Typology;
use App\Type;
use Carbon\Carbon;
use App\Involucrado;
use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'published_at',
        'category_id',
        'user_id',
        'subcategory_id',
        'time',
        'tag_id',
        'address_id',
        'oficio',
        'vehiculo_id',
        'jefe_de_turno_id',
        'modus_operandi_id',
        'typology_id',
        'juzgado',
        'guardia',
        'denunciante',
        'incautacion_id'
    ];

    protected $dates = ['published_at'];

    protected $appends = ['published_date'];

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function address()
    {
        return $this->belongsTo('App\Address', 'address_id');
    }

    public function typology()
    {
        return $this->belongsTo('App\Typology', 'typology_id');
    }

    public function modusoperandi()
    {
        return $this->belongsTo('App\ModusOperandi', 'modus_operandi_id');
    }

    public function vehiculo()
    {
        return $this->belongsTo('App\Vehiculo', 'vehiculo_id');
    }

    public function jefeDeTurno()
    {
        return $this->belongsTo('App\User', 'jefe_de_turno_id')->withTrashed();;
    }

    public function proceden()
    {
        return $this->belongsToMany('App\User')->withTrashed();
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
        return $this->belongsTo('App\User', 'user_id')->withTrashed();
    }

    public function involucrados()
    {
        return $this->belongsToMany('App\Involucrado');
    }

    public function arma()
    {
        return $this->belongsTo('App\Gun', 'gun_id');
    }

    public function incautacion()
    {
        return $this->belongsTo('App\Incautacion', 'incautacion_id');
    }

    public function robo()
    {
        return $this->belongsTo('App\Robo', 'robo_id');
    }


    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }

    public function getPublishedAtAttribute($date)
    {
        $dat = new Date($date);
        return new Date($dat->format('d-m-Y'));
    }

    public function getPublishedDateAttribute()
    {
        return optional($this->published_at)->format('M d');
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

    public function syncTypology($typology)
    {
        // dd($typology);
        $off = Typology::find($typology);
        $val = $off ? $off->id : Typology::create(['name' => $typology, 'url' => str_slug($typology)])->id;
        return $val;
    }

    public function syncModusOperandi($id)
    {
        $modus = ModusOperandi::find($id);
        $val = $modus ? $modus->id : ModusOperandi::create(['name' => $id, 'url' => str_slug($id)])->id;
        return $val;
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

        if(isset($request->offense_id))
        {
            $offenses = $this->syncOffenses($request->offense_id);
        }
        else
        {
            $offenses[]=0;
        }


        $coleccion = collect();
        $i = 0;
        $involucrado = collect($involucrado);

        foreach($involucrado as $in)
        {
            $coleccion->push(['name' => $involucrado[$i], 'dpi' => $dpi[$i], 'gender' => $genero[$i], 'gang_id' => $gangs[$i], 'alias' => $request->alias[$i], 'tattoos' => $request->tattoos[$i], 'age'=>$request->age[$i], 'offense_id' =>$offenses[$i] ]);
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
        // dd($coleccion);
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

    public function syncOffenses($offenses)
    {
        $offensesID = collect();
        foreach($offenses as $offense)
        {
             if($item = Offense::where('name', $offense)->first())
            {
                $offensesID->push($item->id); 
            }
            else
            {
                $offensesID->push( offense::create(['name' => $offense])->id );
            }
        }
        return $offensesID;
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


    public function syncAbordo($abordo)
    {
        $query = Type::where('id', $abordo)->first();
        $abordo =  $query ? $query->id : Type::create(['tipo' => $abordo ])->id;
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
            $ids[] = $query ? $query->id : Vehiculo::create(['placa' => $unidad, 'type_id' => '1'])->id;
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
