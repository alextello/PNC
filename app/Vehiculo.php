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

    public function procesos()
    {
        return $this->belongsToMany('App\Post');
    }

    public function syncTipo($request)
    {
        $query = Movil::where('id', $request)->first();
        $tipo =  $query ? $query->id : Movil::create(['tipo' => $request ])->id;
        return $tipo;
    }

    public function syncMarca($request)
    {
        $query = Marca::where('id', $request)->first();
        $marca =  $query ? $query->id : Movil::create(['tipo' => $request ])->id;
        return $marca;
    }
}
