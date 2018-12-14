<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    const LOCATION_TYPE_ALL = 'all';
    const LOCATION_TYPE_IN = 'in';
    const LOCATION_TYPE_EXCEPT = 'except';
    const LOCATION_TYPE_VIRTUAL = 'virtual';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'featured_image', 'slug', 'resized_featured_image',
//        'location_type'
    ];

    /**
     * The services that belong to the service category.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Models\ServiceCategory', 'service_category', 'service_id', 'category_id');
    }

    /**
     * The services that belong to the service category.
     */
    public function questions()
    {
        return $this->belongsToMany('App\Models\ServiceQuestion', 'service_question', 'service_id', 'question_id');
    }

    /**
     * Get all of the states that are assigned this service.
     */
    public function states()
    {
        return $this->morphedByMany('App\Models\State', 'location', 'service_location',
            'service_id', 'location_id');
    }

    /**
     * Get all of the cities that are assigned this service.
     */
    public function cities()
    {
        return $this->morphedByMany('App\Models\City', 'location', 'service_location',
            'service_id', 'location_id');
    }

    /**
     * Get all of the areas that are assigned this service.
     */
    public function areas()
    {
        return $this->morphedByMany('App\Models\CityArea', 'location', 'service_location',
            'service_id', 'location_id');
    }



    /**
     * Get the requests for the service.
     */
    public function requests()
    {
        return $this->hasMany('App\Models\ServiceRequest');
    }
}
