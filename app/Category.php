<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public function getRouteKeyName()
    {
        return 'url';
    }

    public function tags()
    {
        return $this->hasManyThrough('App\Tag', 'App\Subcategory');
    }

    public function subcategories()
    {
        return $this->hasMany('App\Subcategory');
    }
    
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['url'] = str_slug($name);
    }
}
