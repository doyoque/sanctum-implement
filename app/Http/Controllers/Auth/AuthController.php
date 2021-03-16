<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use \Exception;

class AuthController extends Controller
{
    /**
     * handle login
     *
     * @param Illuminate\Http\Request $request
     * @return string
     */
    public function login(Request $request)
    {
        try {
            $postData = $request->validate([
                'email' => 'email|required',
                'password' => 'required',
            ]);

            if (Auth::attempt($postData)) {
                $user = Auth::user();

                return response()->json([
                    'name' => $user->name,
                    'access_token' => $user->createToken('sanctum')->plainTextToken,
                    'token_type' => 'Bearer',
                ], Response::HTTP_OK);
            }

            throw new Exception('The credentials invalid');
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * handle logout
     *
     * @param App\Models\User $user
     * @return string
     */
    public function logout(User $user)
    {
        try {
            if (Auth::user()->tokens()->where('id', $user->id)->delete()) {
                return response()->json([
                    'message' => 'Token revoked',
                ], Response::HTTP_OK);
            }

            throw new Exception('Oops something wrong');
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
