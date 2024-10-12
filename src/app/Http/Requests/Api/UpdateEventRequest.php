<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateEventRequest extends FormRequest
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
            'id' => 'required|integer|exists:lecons,id',
            'date_arrive' => 'required|date_format:Y-m-d|after_or_equal:'. now()->addDays(5)->toDateString(),
            'start' => 'required|date_format:H:i:s',
            'end' => 'required|date_format:H:i:s|after:start',
        ];
    }

    
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'errors'      => $validator->errors()
        ], 422));
    }
    public function messages()
    {
        return [
            'date_arrive.after_or_equal' => 'La date de réservation doit être postérieure ou égale au ' . now()->addDays(5)->startOfDay()->translatedFormat('l j F Y'),
        ];
    }

}
