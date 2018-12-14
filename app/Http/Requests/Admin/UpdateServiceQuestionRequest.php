<?php

namespace App\Http\Requests\Admin;

use App\Models\ServiceQuestion;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceQuestionRequest extends FormRequest
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
            'name' => 'required|min:3|max:50',
            'question' => 'required|string|min:3|max:200',
            'type' => 'required|string|in:'.
                ServiceQuestion::TYPE_BOOLEAN.','.ServiceQuestion::TYPE_TEXT.','.ServiceQuestion::TYPE_TEXT_MULTILINE.','.ServiceQuestion::TYPE_SELECT.','.ServiceQuestion::TYPE_SELECT_MULTIPLE . ','.ServiceQuestion::TYPE_FILE . ','.ServiceQuestion::TYPE_FILE_MULTIPLE . ','.ServiceQuestion::TYPE_TIME . ','.ServiceQuestion::TYPE_DATE . ','.ServiceQuestion::TYPE_DATE_TIME,
            'choices' => 'required_if:type,'.ServiceQuestion::TYPE_SELECT.','.ServiceQuestion::TYPE_SELECT_MULTIPLE . '|array',
            'choices.*' => 'string|min:3|max:255'
        ];
    }
}
