<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModusOperandi extends Model
{
    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function syncModusOperandi($modus)
    {
        $modusID = collect();
        foreach($modus as $mod)
        {
             if($item = ModusOperandi::where('name', $mod)->first())
            {
                $modusID->push($item->id); 
            }
            else
            {
                $modusID->push( ModusOperandi::create(['name' => $mod])->id );
            }
        }
        return $modusID;
    }
}
