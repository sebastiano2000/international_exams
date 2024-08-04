<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'attachment' => 'required|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4,video/wav,video/webm,video/ogg,video/flv,video/3gpp,video/3gpp2,video/x-msvideo,video/x-ms-wmv,video/x-flv,video/x-matroska,video/x-ms-asf,video/x-m4v,video/x-m4v'
        ];
    }
}
