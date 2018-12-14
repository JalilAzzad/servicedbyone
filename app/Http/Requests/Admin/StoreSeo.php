<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use App\Models\Seo;
use Illuminate\Foundation\Http\FormRequest;

class StoreSeo extends FormRequest
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
            'url' => 'required|min:3|max:255|unique:seos,url',
            'slug' => 'required|min:3|max:191',
            'keywords' => 'required|min:3',
            'meta_desc' => 'required|min:3',
        ];


    }

        public function messages()
    {
        return [
        'slug.required' => 'A title is required',
        'slug.min'  => 'Length must be greater then 3 for title',
        'slug.max'  => 'Length must be lesser then 255 for title',
        ];
   }
}
