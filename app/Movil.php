<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movil extends Model
{
    protected $guarded = [];

    public function vehiculos()
    {
        return $this->hasMany('App\Vehiculo');
    }
}
