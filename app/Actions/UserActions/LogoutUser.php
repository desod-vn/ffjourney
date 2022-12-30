<?php

namespace App\Actions\UserActions;

use Illuminate\Http\Response;
use Exception;
use Illuminate\Support\Facades\Auth;

class LogoutUser
{
    public static function execute(): array
    {
        try {
            $user = Auth::user();
            $user->currentAccessToken()->delete();
            return [
                'status' => Response::HTTP_OK,
                'success' => true,
                'data' => [
                    'user' => $user,
                    'token' => null
                ]
            ];
        } catch (Exception $e) {
            return [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}