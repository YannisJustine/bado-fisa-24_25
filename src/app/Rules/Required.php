<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class Required implements ValidationRule, DataAwareRule
{

    protected $implicit = true;
    /**
     * The data under validation.
     *
     * @var array
     */
    protected array $data;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! Arr::has($this->data, $attribute) || is_null(Arr::get($this->data, $attribute))) {
            $fail($attribute.' is required');
        }
    }

    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }
}
