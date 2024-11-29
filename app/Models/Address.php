<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'line1',
        'line2',
        'city',
        'province',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'description',
    ];


    public function eventsAsOrigin()
    {
        return $this->hasMany(Event::class, 'origin_address_id');
    }

    public function eventsAsDestination()
    {
        return $this->hasMany(Event::class, 'destination_address_id');
    }

}
