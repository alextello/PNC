<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $fillable = ['type_id', 'marca_id', 'color', 'modelo', 'placa', 'linea'];

    public function tipo()
    {
        return $this->belongsTo('App\Type', 'type_id');
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
        $query = Type::where('id', $request)->first();
        $tipo =  $query ? $query->id : Type::create(['tipo' => $request, 'modelo' => 'App\Vehiculo'])->id;
        return $tipo;
    }

    public function syncMarca($request)
    {
        $query = Marca::where('id', $request)->first();
        $marca =  $query ? $query->id : Marca::create(['name' => $request ])->id;
        return $marca;
    }
}
