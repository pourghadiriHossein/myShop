<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|min:3|max:100',
            'password' => 'required|min:3|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'نام خود را وارد کنید',
            'name.min' => 'نام شما باید بیشتر از 3 حرف باشد',
            'name.max' => 'نام شما نباید بیشتر از 100 حرف باشد',
            'phone.required' => 'شماره تماس خود را وارد کنید',
            'phone.digits_between' => 'شماره تماس شما نباید کمتر از 11 و بیشتر از 15 رقم باشد',
            'email.required' => 'پست الکترونیک خود را وارد کنید',
            'email.email' => 'پست الکترونیک معتبر وارد کنید',
            'email.min' => 'پست الکترونیک شما نباید کمتر از 3 حرف باشد',
            'email.max' => 'پست الکترونیک شما نباید بیشتر از 100 حرف باشد',
            'password.required' => 'رمز عبور نباید خالی باشد',
            'password.min' => 'کمترین حد مقدار رمز عبور برابر با 3 است',
            'password.max' => 'بیشترین حد مقدار رمز عبور برابر با 100 است',
        ];
    }
}
