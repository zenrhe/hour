<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function logs()
    {
       // return $this->hasMany('App\Log');
        return $this->hasMany(Log::class);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeActive($query, $id)
    {
        //App\User::active()->where('id', '=', 1)->get();

        return $query->where('active', 1);
    }

    public static function notActive()
    {
        return static::where('active', 0)->get();
    }
}
