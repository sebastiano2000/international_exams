<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ContactRequest  extends FormRequest
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
            'phone' => 'required',
            'name' => 'required',
            'message' => 'required',
        ];
    }

 
    public function messages()
    {
        return [
            'name.required' => 'يجب عليك إدخال  الإسم',
            'phone.required' => 'يجب عليك إدخال رقم الجوال',
            'message.required' => 'يجب عليك إدخال  محتوي الرساله',
        ];
    }
   
}
