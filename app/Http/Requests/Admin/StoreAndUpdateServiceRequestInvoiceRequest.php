<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreAndUpdateServiceRequestInvoiceRequest extends FormRequest
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
            'detail' => 'required|array',
            'cost' => 'required|array',
            'quantity' => 'required|array',
            'detail.*' => 'required|string|min:3',
            'cost.*' => 'required|numeric|min:0',
            'quantity.*' => 'required|numeric|min:0',
            'mail' => ''
        ];
    }
}
