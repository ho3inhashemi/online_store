<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;


class ArrayMembersExist implements ValidationRule
{
    private string $model;

    public function __construct(string $model)
    {
        $this->model = $model;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $arrayCount = count($value);
        $tableRecordsCount = ($this->model)::whereIn('id' , $value)->count();

        if($arrayCount !== $tableRecordsCount){
            $fail("These resource identifiers are not existed in database");
        }
    }
}
