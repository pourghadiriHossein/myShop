<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'phone' => 'required|digits_between:11,15',
            'password' => 'required|min:3|max:100',
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'شماره تلفن باید وارد شود',
            'phone.digits_between' => 'شماره تلفن باید عددی باشد و بین 11 تا 15 رقم باشد',
            'password.required' => 'رمز عبور نباید خالی باشد',
            'password.min' => 'کمترین حد مقدار رمز عبور برابر با 3 است',
            'password.max' => 'بیشترین حد مقدار رمز عبور برابر با 100 است',
        ];
    }
}
