<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodeFormulaRequest extends FormRequest
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
            'formule_id' => 'required|exists:formules_code,formule_id',
            'date_debut' => 'required|date|after_or_equal:today',
        ];
    }
}
