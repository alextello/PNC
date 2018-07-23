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
    ];

    public function getRouteKeyName()
    {
        return 'dpi';
    }
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    public function mara()
    {
        return $this->belongsTo('App\Gang');
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

