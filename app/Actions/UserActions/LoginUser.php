<?php

namespace App\Actions\UserActions;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginUser
{
    public static function execute(array $credentials) : array
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return [
                'status' => Response::HTTP_OK,
                'success' => true,
                'data' => [
                    'user' => $user,
                    'token' => $user->createToken('token')->plainTextToken,
                ] 
            ];
        }
        throw ValidationException::withMessages([
            'message' => 'The email or password is incorrect.',
        ]);
    }
}