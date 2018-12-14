<?php

namespace App\Http\Requests\Admin;

use App\Models\Partner;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnerRequest extends FormRequest
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
            'email' => 'required|min:3|max:255|unique:partners,email,' . $this->partnerId,
            'phone' => 'required|max:20|unique:partners,phone,' . $this->partnerId,
            'website' => 'max:255',
            'slug' => 'required|min:3|max:255|unique:partners,slug,' . $this->partnerId,
            'description' => 'required|string|max:10000',
            'featured_image' => 'file|image|max:5000'
        ];
    }
}
