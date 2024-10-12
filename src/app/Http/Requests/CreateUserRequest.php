<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email'=> 'required|email|unique:users,email',
            'seq' => ['required', 'regex:/^(1|2)([0-9]{2})(0[1-9]|1[0-2])([0-9]{8})$/', 'unique:users,num_securite_sociale'],
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8|same:password',
            'habilitation' => 'required|array',
            'habilitation.*' => 'integer|exists:App\Models\TypePermis,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Le prénom est requis',
            'first_name.string' => 'Le prénom doit être une chaîne de caractères',
            'first_name.max' => 'Le prénom ne doit pas dépasser 255 caractères',
            'last_name.required' => 'Le nom est requis',
            'last_name.string' => 'Le nom doit être une chaîne de caractères',
            'last_name.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'email.required' => 'L\'email est requis',
            'email.email' => 'L\'email doit être une adresse email valide',
            'email.unique' => 'L\'email est déjà utilisé',
            'phone.required' => 'Le numéro de téléphone est requis',
            'phone.regex' => 'Le numéro de téléphone doit être un numéro de téléphone valide',
            'address.required' => 'L\'adresse est requise',
            'address.string' => 'L\'adresse doit être une chaîne de caractères',
            'address.max' => 'L\'adresse ne doit pas dépasser 255 caractères',
            'birthday.required' => 'La date de naissance est requise',
            'birthday.date' => 'La date de naissance doit être une date valide',
            'birthday.before' => 'La date de naissance doit être avant aujourd\'hui',
        ];
    }
}