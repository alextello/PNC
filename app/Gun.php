<?php

namespace App;

use App\Type;
use App\Marca;
use Illuminate\Database\Eloquent\Model;

class Gun extends Model
{
    protected $fillable = ['type_id','marca_id','registrio','licencia','calibre'];

    public function post()
    {
        return $this->hasOne('App\Post');
    }

    public function tipo()
    {
        return $this->belongsTo('App\Type', 'type_id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Marca', 'marca_id');
    }

    public function syncTipo($request)
    {
        $query = Type::where('tipo', $request)->first();
        $tipo =  $query ? $query->id : Type::create(['tipo' => $request, 'modelo' => 'App\Gun'])->id;
        return $tipo;
    }

    public function syncMarca($request)
    {
        $query = Marca::where('name', $request)->first();
        $marca =  $query ? $query->id : Marca::create(['name' => $request, 'modelo' => 'App\Gun' ])->id;
        return $marca;
    }
}
