<?php

namespace App\Actions;

use App\Exceptions\UnprocessableException;
use Illuminate\Support\Facades\Validator;

class ValidatorHelper
{
    public function handle(array $rules)
    {
        $validator = Validator::make(request()->all(), $rules);

        if ($validator->fails()) {

            throw new UnprocessableException(errors: ['errors' => $validator->errors()->toArray()]);
        }
    }
}
