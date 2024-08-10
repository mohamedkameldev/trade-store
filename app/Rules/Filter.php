<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    protected $forbiddenWords;

    public function __construct($forbiddenWords)
    {
        $this->forbiddenWords = $forbiddenWords;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(in_array(strtolower($value), $this->forbiddenWords)) {
            $fail("the keyword $value is not allowed for the $attribute field");
        }
    }
}
