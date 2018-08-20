<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typology extends Model
{
    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function syncTypology($typology)
    {
        $gangsID = collect();
        foreach($gangs as $gang)
        {
             if($item = Gang::where('name', $gang)->first())
            {
                $gangsID->push($item->id); 
            }
            else
            {
                $gangsID->push( Gang::create(['name' => $gang])->id );
            }
        }
        return $gangsID;
    }
}
