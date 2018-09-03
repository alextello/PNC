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
        $typologyID = collect();
        foreach($typology as $typo)
        {
             if($item = Typology::where('name', $typo)->first())
            {
                $typologyID->push($item->id); 
            }
            else
            {
                $typologyID->push( Typology::create(['name' => $typo])->id );
            }
        }
        return $typologyID;
    }
}
