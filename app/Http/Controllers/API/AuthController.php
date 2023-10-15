<?php

namespace App\Http\Controllers\API;

use App\Exceptions\UserNotExists;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Trait\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ResponseHelper;

    public function login(LoginRequest $request)
    {
        $user = User::whereName($request->name)->first();

        if (!$user) {

            throw new UserNotExists();
        }

        if (!Hash::check($request->password, $user->password)) {

            return $this->responseUnauthroized(
                message: 'Password incorrect.'
            );
        }

        return $this->responseSucceed(data: [
            'user' => new UserResource($user),
            'token' => accessToken(user: $user)
        ], message: 'Login Success.');
    }
}
