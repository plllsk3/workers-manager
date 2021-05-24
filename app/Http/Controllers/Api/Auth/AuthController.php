<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\Auth\TokenAuthRequest;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Return access_token if user is authorized.
     *
     * @param Illuminate\Foundation\Http\FormRequest $request
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function token(TokenAuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The given data was invalid',
                'errors' => [
                    'password' => [
                        'Invalid credentials'
                    ]
                ]
            ], 422);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        return response()->json([
            'data' => [
                'access_token' => $token
            ]
        ]);
    }
}
