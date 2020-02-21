<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\LoginRequest;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        auth()->attempt([
            'email' => $request->username,
            'password' => $request->password,
        ]);
        if (auth()->check()) {
            return response([
                'api_token' => auth()->user()->generateApiToken(),
            ]);
        }
        return response([
            'error' => "wrong info!"
        ], 403);
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function logout()
    {
        $user = auth('api')->user();
        $user->logout();

        return $user;
    }

    public function user()
    {
        return auth('api')->user();
    }
}
