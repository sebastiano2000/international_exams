<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'phone' => [function($attribute,$value,$fail){
                $count = User::where('phone',$value)->where(function($query){
                    $query->where('id','!=',$this->id);
                })->count();

                if ( $count ) {
                    return $fail("This mobile number already exist");
                }

            }]
        ];
    }
}
