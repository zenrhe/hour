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
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
   
    public function isAdmin()
    {    
        return $this->admin; // this looks for an admin column in your users table
    }

    public static function hasLogsInPeriod($searchPeriod) {

        return User::findMany(
                Log::months($searchPeriod)->with('user')->pluck('user_id')->unique()
            );
    }

    public function scopeActive($query, $id)
    {
        //App\User::active()->where('id', '=', 1)->get(); //usage

        return $query->where('active', 1);
    }
    public static function notActive()
    {
        return static::where('active', 0)->get();
    }

    public function avatar()
    {
        $url= url('/').'/avatars/'.$this->id .'/avatar.jpeg';
        return '/avatars/'.$this->id .'/avatar.jpeg';

        //Requires non SSL
        // if (false!==file($url)){
        //    return '/avatars/'.$this->id .'/avatar.jpeg';
        // }
        // else{
        //     return '/avatars/missing.jpeg';
        // }

        // public_path() used in examples but returns /Users/rowanevenstar/Web/hours/public/
        // $url="http://hours.dev/avatars/11/avatar.jpeg"; //real url
        
        //This always comes back false, with or without SSL
        // if(file_exists($url)) {
        //     return '/avatars/'.$this->id .'/avatar.jpeg';
        // } else {
        //     return '/avatars/missing.jpeg';
        // }      
    }
}
