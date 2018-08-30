<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];
    
    public function getRouteKeyName()
    {
        return 'url';
    }

    public function posts()
    {
       return $this->hasMany('App\Post');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory', 'subcategory_id');
    }
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['url'] = str_slug($name);
    }
}
