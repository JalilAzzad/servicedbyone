<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'states';


    /**
     * Get the cities of the state.
     */
    public function cities()
    {
        return $this->hasMany('App\Models\City', 'state_code', 'state_code');
    }


    /**
     * Get all of the posts for the country.
     */
    public function areas()
    {
        return $this->hasManyThrough(
            'App\Models\CityArea',
            'App\Models\City',
            'state_code',
            'city_id',
            'state_code',
            'id'
        );
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
