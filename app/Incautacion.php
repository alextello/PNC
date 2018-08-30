<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incautacion extends Model
{
    protected $fillable = ['descripcion'];

    protected $table = 'incautaciones';

    public function post()
    {
        return $this->hasOne('App\Post');
    }


}
