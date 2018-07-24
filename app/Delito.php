<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delito extends Model
{
    protected $guarded = [];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['url'] = str_slug($name);
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
