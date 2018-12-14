<?php

namespace App\Http\Requests\Admin;

use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (auth()->check() && auth()->user()->hasRole(User::ADMIN));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:255',
            'description' => 'required|string|max:10000',
//            'location_type' => 'required|string|in:'.Service::LOCATION_TYPE_ALL.','.Service::LOCATION_TYPE_EXCEPT.','.Service::LOCATION_TYPE_IN.','.Service::LOCATION_TYPE_VIRTUAL,
            'locations' => 'required|array',
            'locations.*' => 'integer|exists:cities,id',
            'categories' => 'required|array',
            'categories.*' => 'integer|exists:service_categories,id',
            'questions' => 'array',
            'questions.*' => 'integer|exists:service_questions,id',
            'featured_image' => 'file|image|max:5000'
        ];
    }
}
