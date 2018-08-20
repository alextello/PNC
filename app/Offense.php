<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offense extends Model
{
    protected $guarded = [];

    public function involucrados()
    {
        return $this->hasMany('App\Involucrado');
    }

   public function setNameAttribute($name)
    {
        $this->attributes['url'] = str_slug($name);
        $this->attributes['name'] = $name;
    }
}
