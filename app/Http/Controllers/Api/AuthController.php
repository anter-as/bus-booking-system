<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Password::min(6)->mixedCase()->numbers()]
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error!',
                'errors' => $validator->errors()
            ], 400);
        }

        $user = User::create($request->all());

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken
        ]);
    }
}
