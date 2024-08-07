<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
            'name' => 'required|min:3',
            'phone' => ['required'],
            'high' => 'required|min:3'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'يجب عليك إدخال الاسم',
            'phone.required' => 'يجب عليك إدخال رقم الهاتف',
            'phone.digits' => 'يجب أن يكون رقم الهاتف 8 أرقام',
            'password.required' => 'يجب عليك إدخال  كلمة السر',
            'password.confirmed' => 'تأكيد كلمة السر غير متطابق',
            'phone.unique' => 'رقم الهاتف مسجل لدينا بالفعل',
        ];
    }
}
