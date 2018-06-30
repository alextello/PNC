<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];

    public function municipio()
    {
        return $this->belongsTo('App\Municipio');
    }

    public function post()
    {
        return $this->hasOne('App\Post');
    }
}
