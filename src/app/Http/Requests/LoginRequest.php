<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
        $regexp = '/^(1|2)([0-9]{2})(0[1-9]|1[0-2])([0-9]{8})$/';
        return [
            'num_secu' => [
                            'required',
                            'regex:' . $regexp,
                        ],
            'password' => 'required|string',
            'remember' => 'sometimes',
        ];
    }
}
