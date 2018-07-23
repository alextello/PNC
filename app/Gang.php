<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gang extends Model
{
    protected $guarded = [];

    public function involucrado()
    {
        return $this->hasMany('App\Involucrado');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function setNameAttribute($name)
    {
        $this->attributes['url'] = str_slug($name);
        $this->attributes['name'] = $name;
    }
}
