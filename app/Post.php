<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
        'excerpt',
        'published_at',
        'category_id',
    ];

    protected $dates = ['published_at'];

    public function getRouteKeyName()
    {
        return 'url';
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
        return $this->belongsToMany('App\Tag');
    }

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['url'] = str_slug($title);
    }

    public function setCategoryIdAttribute($category)
    {
        $this->attributes['category_id'] = Category::find($category) ? $category : Category::create(['name' => $category])->id;
    }

    public function setPublishedAtAttribute($published_at)
    {
        $this->attributes['published_at'] = Carbon::parse($published_at);
    }

    public function syncTags($tag)
    {
        $tagIds = collect($tag)->map(function($tag){
            return Tag::find($tag) ? $tag : Tag::create([ 'name' => $tag])->id;
        });

        return $this->tags()->sync($tagIds);
    }

}
