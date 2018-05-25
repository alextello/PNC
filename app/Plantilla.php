<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    protected $fillable = ['name', 'body'];


    public function scopeAllowed($query)
    {
        if(auth()->user()->can('view', $this))
        {
            return $query;
        }
        else
        {
             return null;
        }
    }

}
