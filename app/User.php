<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'telefono', 'codigo', 'reference'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function created_by()
    {
        return $this->hasMany('App\Post');
    }

    public function procesos()
    {   
        return $this->belongsToMany('App\Post');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }


    public function scopeAllowed($query)
    {
        if(auth()->user()->can('view', $this))
        {
            return $query;
        }
        else
        {
             return $query->where('id', auth()->id());
        }
    }
}
