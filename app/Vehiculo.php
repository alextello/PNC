<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $guarded = [];

    public function tipo()
    {
        return $this->belongsTo('App\Movil', 'tipo_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Marca', 'marca_id');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
