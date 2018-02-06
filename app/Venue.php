<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Venue;



class Venue extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function scopeActive($query, $val)
    {
        return $query->where('active', 1);
    }

    public static function notActive()
    {
        return static::where('active', 0)->get();
    }
}
