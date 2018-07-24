<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];

    public function aldea()
    {
        return $this->belongsTo('App\Aldea');
    }

    public function post()
    {
        return $this->hasOne('App\Post');
    }
}
