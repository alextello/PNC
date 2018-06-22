<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $guarded = [];
    
    public function getRouteKeyName()
    {
        return 'url';
    }


    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }

    public function posts()
    {
        return $this->hasManyThrough('App\Post', 'App\Tag');
    }

    public function syncTags($tag)
    {
        $tagIds = collect($tag)->map(function($tag){
            return Tag::find($tag) ? $tag : Tag::create([ 'name' => $tag])->id;
        });

        return $this->tags()->sync($tagIds);
    }
    
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['url'] = str_slug($name);
    }
}
