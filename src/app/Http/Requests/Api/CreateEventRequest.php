<?php

namespace App\Http\Requests\Api;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateEventRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'date_reservation' => 'required|date_format:Y-m-d|after_or_equal:'. now()->addDays(5)->toDateString(),
            'candidat_id' => 'required|integer|exists:candidats,id',
            'type_heure' => ['required',Rule::in(['conduite', 'accompagnement'])],
            'type_heure_conduite' => ['required_if:type_heure,conduite', Rule::in(['formule', 'supplementaire'])],
            'type_permis_id' => [ 'required_if:type_heure_conduite,supplementaire', 'prohibited_if:type_heure_conduite,formule', 'prohibited_if:type_heure,accompagnement', 'integer', 'exists:type_permis,id'],
            'formule_id' => ['required_if:type_heure_conduite,formule','required_if:type_heure,accompagnement', 'prohibited_if:type_heure_conduite,supplementaire', 'integer', 'exists:formules_conduite,formule_id'],
            'formateur_id' => 'required|integer|exists:users,id',
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
            'date_reservation.after_or_equal' => 'La date de réservation doit être postérieure ou égale au ' . Carbon::now()->addDays(5)->startOfDay()->translatedFormat('l j F Y'),
        ];
    }

    public function attributes()
    {
        return [
            'candidat_id' => 'candidat',
            'formule_id' => 'formule',
            'formateur_id' => 'formateur', 
            'type_permis_id' => 'type de permis',
    
        ];
    }
}
