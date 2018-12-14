<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityArea extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'city_areas';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_id'
    ];

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getZipAttribute($value)
    {
        return sprintf("%05d", $value);
    }

    /**
     * Get the city that owns the area.
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
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
