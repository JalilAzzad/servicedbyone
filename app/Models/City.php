<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cities';


    /**
     * Get the state that owns the city.
     */
    public function state()
    {
        return $this->belongsTo('App\Models\State', 'state_code', 'state_code');
    }

    /**
     * Get the cities of the state.
     */
    public function areas()
    {
        return $this->hasMany('App\Models\CityArea', 'city_id', 'id');
    }

    /**
     * Get all of the services for the city area.
     */
    public function services()
    {
        return $this->morphToMany('App\Models\Service', 'location', 'service_location',
            'location_id', 'service_id');
    }
}
