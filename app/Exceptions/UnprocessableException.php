<?php

namespace App\Exceptions;

use App\Trait\ResponseHelper;
use Exception;

class UnprocessableException extends Exception
{
    use ResponseHelper;

    public function __construct(public array $errors)
    {
    }

    public function render()
    {
        return $this->responseValidationErrors(errors: $this->errors);
    }
}
