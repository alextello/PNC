<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Robo extends Model
{
    protected $fillable = ['descripcion'];

    public function post()
    {
        return $this->hasOne('App\Post');
    }
}
