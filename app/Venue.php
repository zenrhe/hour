<?php

namespace App;

use App\Venue;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public static function notActive()// this should also be a scope.
    {
        return static::where('active', 0)->get();
    }
}
