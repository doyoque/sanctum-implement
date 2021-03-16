<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use \Exception;

class RegisterController extends Controller
{
    /**
     * Store new user
     *
     * @param Illuminate\Http\Request $request
     * @return string
     */
    public function register(Request $request)
    {
        try {
            $postData = $request->validate([
                'email' => 'required|email',
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'name' => $postData['name'],
                'email' => $postData['email'],
                'password' => Hash::make($postData['password']),
            ]);

            if ($user) {
                return response()->json([
                    'access_token' => $user->createToken('sanctum')->plainTextToken,
                    'token_type' => 'Bearer',
                ], Response::HTTP_CREATED);
            }

            throw ValidationException::withMessages(['message' => 'The given data was invalid.']);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
