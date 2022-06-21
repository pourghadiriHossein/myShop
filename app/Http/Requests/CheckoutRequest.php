<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CheckoutRequest extends FormRequest
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
        if ($this->input('previousAddress'))
        {
            return [
                'previousAddress' => 'integer',
                'terms' => 'required',
            ];
        }else{
                return [
                'newAddress' => 'required',
                'zoneID' => 'required',
                'detail' => 'required|min:3|max:1000',
                'terms' => 'required',
            ];
        }   
    }

    public function messages()
    {
        return [
            'previousAddress.integer' => 'آدرس پیش فرض دچار مشکل شده است',
            'newAddress.required' => 'آدرس باید تعیین شود',
            'zoneID.required' => 'ناحیه باید انتخاب شود',
            'detail.required' => 'جزئیات آدرس باید وارد شود',
            'detail.min' => 'جزئیات آدرس باید حد اقل ۳ حرف باشد',
            'detail.max' => 'جزئیات آدرس نمی تواند بیش تر از ۱۰۰۰ حرف باشد',
            'terms.required' => 'پزیرفتن قوانین صورت نگرفته! لطفا تیک پذیرفتن را بزنید'
        ];
    }
}    
