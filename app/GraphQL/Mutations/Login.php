<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Exceptions\UserNotExists;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Trait\ResponseHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class Login
{
    use ResponseHelper;
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $user = User::whereName($args['name'])->first();

        if (!$user || !Hash::check($args['password'], $user->password)) {

            throw ValidationException::withMessages([
                'name' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $this->generateToken(user: $user);

        return [
            'success' => true,
            'user' => new UserResource($user),
            'token' => $token,
        ];
    }

    private function generateToken(User $user)
    {
        if ($user->tokens->count() > 0) {

            $user->tokens->each->delete();
        }

        $token = $user->createToken($user->name)->accessToken;

        return $token;
    }

    public function me()
    {

        return [
            'success' => true,
            'user' => new UserResource(auth()->user()),
        ];
    }
}
