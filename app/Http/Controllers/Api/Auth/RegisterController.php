<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Api\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\Auth\RegisterAuthRequest;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Register new user via laravel/sanctum.
     *
     * @param Illuminate\Foundation\Http\FormRequest $request
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function register(RegisterAuthRequest $request)
    {
        $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $token = $user->createToken('my-app-token')->plainTextToken;

        return response()->json([
            'data' => $user
        ]);
    }
}
