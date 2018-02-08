<?php

namespace App;

use App\Log;
use App\User;
use App\Venue;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Log extends Model
{
    use Notifiable;

    protected $dates = ['dateWorked'];

    protected $fillable = [
        'user_id',
        'hours',
        'dateWorked',// check out the $dates feature of Model in the Laravel docs
        // https://laravel.com/docs/5.5/eloquent-mutators#date-mutators
        'description',
        'venue_id',
        'submitted',
    ];

    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function getApprovedByUserAttribute()
    {
        return User::findOrNew($this->approvedBy);
    }

    public function scopeMonths($query, $months)
    {
            $endDate = new Carbon('now');
            $startDate = date('Y-m-d', strtotime("-{$months} months"));

            $query->whereBetween('dateWorked', [$startDate, $endDate]);
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

    // TODO you can use this in venues.show instead of doing it inline
    // just say $venue->logs->forMonth->sum('hours')
    //
    // for extra credit add a hoursForMonth method to Venue that just
    // pulls this in for the logs of the current Venue,
    // and then you can just say $venue->hoursForMonth()
    //
    // or !
    //
    // for extra extra credit, use an accessor method ( getHoursForMonthAttribute() )
    // and then you don't even have to call a method and can say
    // $venue->hoursForMonth
    // !! :)
    // https://laravel.com/docs/5.5/eloquent-mutators#defining-an-accessor
    public function scopeForMonth($query)
    {
        $query->where(
            'submitted',
            '>=',
            Carbon::now()->startOfMonth()
        );
    }
}
