<?php


namespace App\Models\Validation;


interface IValidation
{
    public function validate(array $request);
}
