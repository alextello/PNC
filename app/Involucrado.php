<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Involucrado extends Model
{
    protected $fillable = [
        'gender',
        'genero',
        'name',
        'tattoos',
        'gang_id',
        'dpi',
        'age',
        'offense_id',
        'alias',
        'aprehendido',
        'fallecido',
        'heridas',
        'motivo',
        'type_id',
        'offense_id',
        'diagnostico',
        'observaciones'

    ];

    public function getRouteKeyName()
    {
        return 'dpi';
    }
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    public function delito()
    {
        return $this->belongsTo('App\Offense', 'offense_id');
    }

    public function mara()
    {
        return $this->belongsTo('App\Gang', 'gang_id');
    }

    public function movil()
    {
        return $this->belongsTo('App\Type', 'type_id');
    }
    
    public function setGenderAttribute($genero)
    {
        if($genero === 'M'){

            $this->attributes['genero'] = 'Masculino';
            $this->attributes['gender'] = $genero;
        }
        else{

            $this->attributes['genero'] = 'Femenino';
            $this->attributes['gender'] = 'F';
        }
    }

}

