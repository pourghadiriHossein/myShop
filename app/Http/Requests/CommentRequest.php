<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'description' => 'required|min:3|max:10000'
        ];
    }

    public function messages()
    {
        return [
            'description.required' => 'نظر نمی تواند خالی باشد',
            'description.min' => 'نظر شما باید حداقل 3 حرف باشد',
            'description.max' => 'نظر شما نمی تواند بیشتر از 10000 حرف باشد.',
        ];
    }
}
