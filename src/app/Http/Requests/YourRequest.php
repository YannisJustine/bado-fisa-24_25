<?php

namespace App\Http\Requests;

use App\Rules\Required;
use Illuminate\Foundation\Http\FormRequest;

class YourRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
{
    return [
        'answers[1][0]' => ['array', new Required()],

    ];
}

public function withValidator($validator)
{
    $validator->after(function ($validator) {
        $answers = array_filter($this->input('answers', []));
        if (empty($answers)) {
            $validator->errors()->add('answers', 'Vous devez sélectionner au moins une réponse.');
        }
    });
}

}
