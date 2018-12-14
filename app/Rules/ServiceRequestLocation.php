<?php

namespace App\Rules;

use App\Models\CityArea;
use App\Models\State;
use Illuminate\Contracts\Validation\Rule;

class ServiceRequestLocation implements Rule
{
    protected $service_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($service_id)
    {
        $this->service_id = (int) $service_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $query = \DB::table('service_location')
            ->where([
                ['service_location.service_id', '=', $this->service_id],
                ['service_location.location_id', '=', CityArea::where('zip', (int) $value)->first()->city->state->id],
                ['service_location.location_type', '=', State::class]
            ]);

        return $query->count() > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The zip code is invalid or this service is not available for your location.';
    }
}
