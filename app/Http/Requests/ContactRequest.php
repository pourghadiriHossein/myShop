<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:100',
            'phone' => 'required|digits_between:11,15',
            'description' => 'required|min:3|max:10000'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام شما باید وارد شود',
            'name.min' => 'نام شما نباید کمتر از 3 حرف باشد',
            'name.max' => 'نام شما نباید بیشتر از 100 حرف باشد',
            'phone.required' => 'شماره تماس شما باید وارد شود',
            'phone.digits_between' => 'شماره تماس باید عددی و نباید کمتر از 11 رقم و بیشتر از 15 رقم باشد',
            'description.required' => 'توضیحات باید وارد شود',
            'description.min' => 'توضیحات نمی تواند کمتر از 3 حرف باشد',
            'description.max' => 'توضیحات نمی تواند بیشتر از 10000 حرف باشد',
        ];
    }
}
