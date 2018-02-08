<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getProfileAttribute()
    {
        return User::findOrNew($this->profile);
    }

    /* Defauly Venues - Venue returns full venue model, V1name just returns the name string*/
    public function getVenue1Attribute()
    {
        return Venue::findOrNew($this->default_venue_1);
    }
    public function getV1nameAttribute()
    {
        return Venue::findOrNew($this->default_venue_1)->name;
    }
    public function getVenue2Attribute()
    {
        return Venue::findOrNew($this->default_venue_2);
    }
    public function getV2nameAttribute()
    {
        return Venue::findOrNew($this->default_venue_2)->name;
    }
    public function getVenue3Attribute()
    {
        return Venue::findOrNew($this->default_venue_3);
    }
    public function getV3nameAttribute()
    {
        return Venue::findOrNew($this->default_venue_3)->name;
    }
    
}
