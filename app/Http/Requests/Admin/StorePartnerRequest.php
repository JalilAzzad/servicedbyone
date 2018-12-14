<?php

namespace App\Http\Requests\Admin;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StorePartnerRequest extends FormRequest
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
            'email' => 'required|min:3|max:255|unique:partners,email',
            'phone' => 'required|max:20|unique:partners,phone',
            'website' => 'max:255',
            'slug' => 'required|min:3|max:255|unique:partners,slug',
            'description' => 'required|string|max:10000',
            'featured_image' => 'required|file|image|max:5000'
        ];
    }
}
