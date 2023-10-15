<?php

namespace App\Exceptions;

use App\Trait\ResponseHelper;
use Exception;
use Illuminate\Http\Response;

class UserNotExists extends Exception
{
    use ResponseHelper;

    public function render()
    {
       return $this->responseUnauthroized(message: 'User does not exists', code: Response::HTTP_NOT_FOUND);
    }
}
