<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest\RegisterRequest;
use App\Http\Requests\AuthRequest\LoginRequest;
use App\Actions\UserActions\CreateUser;
use App\Actions\UserActions\LoginUser;
use App\Actions\UserActions\LogoutUser;

class AuthController extends Controller
{
    public function logout()
    {
        $result = LogoutUser::execute();
        return response()->json($result, $result['status']);
    }

    public function login(LoginRequest $request)
    {
        $result = LoginUser::execute($request->only(['email', 'password']));
        return response()->json($result, $result['status']);
    }

    public function register(RegisterRequest $request)
    {
        $result = CreateUser::execute($request->only(['name', 'email', 'password']));
        return response()->json($result, $result['status']);
    }
}
