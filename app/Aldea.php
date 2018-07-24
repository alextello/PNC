<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aldea extends Model
{
    protected $guarded = [];

    public function municipio()
    {
        $this->belongsTo('App\Municipio');
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['url'] = str_slug($name);
    }
}
