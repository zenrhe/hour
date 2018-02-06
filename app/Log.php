<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Log extends Model
{
    use Notifiable;

    protected $fillable = [
        'user_id', 'hours', 'dateWorked','description','venue_id','submitted',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
   
    public function approvedBy()
    {
        //TODO AppovedBy lookup doesnt work 

        // return $this->belongsTo(User::class, 'id');
        return $this->belongsTo(User::class, 'approvedBy');
    }

    public function scopeFilter($query, $filters)
    {
        if($searchPeriod = $filters['searchPeriod'])//prefer string not array
        {
            $endDate = new Carbon('now');
            $startDate = date('Y-m-d', strtotime("-$searchPeriod months"));

            $query->whereBetween('dateWorked', [$startDate, $endDate]); 
        }
    }
    public static function archives()
    {
        //TODO cant get this to work from tutoial example
        //complains about static from service provider
        
        return static::$archives = Log::selectRaw('year(dateWorked) year, monthname(dateWorked) month, count(*) logged')
        ->groupBy('year', 'month')
        ->orderByRaw('min(dateWorked) desc')
        ->get()
        ->toArray();
    }


}
