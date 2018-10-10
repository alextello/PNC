<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Headers extends Model
{
    protected $table = 'headers';
    protected $fillable = [
        'default_header',
        'default_footer'
    ];
}
