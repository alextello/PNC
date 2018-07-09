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
        'excerpt',
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

    public function syncInvolucrados($involucrado, $dpi, $genero)
    {
        $coleccion = collect();
        $i = 0;
        $involucrado = collect($involucrado)->filter()->all();
        
        foreach($involucrado as $in)
        {
            $coleccion->push(['name' => $involucrado[$i], 'dpi' => $dpi[$i], 'gender' => $genero[$i]]);
            $i++;
        }

        // $involucradosIds = $coleccion->map(function($coleccion){
        //     return Involucrado::find( $coleccion['dpi']) ? $coleccion : Involucrado::create($coleccion)->id;
        // });
        // dd($involucradosIds);
        $in = [];
        foreach($coleccion as $col)
        {
            $found = Involucrado::find($col)->first();
            $in[] = $found ? $found->id : Involucrado::create($col)->id;
        }
        // dd($in);
        return $this->involucrados()->sync($in);

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
