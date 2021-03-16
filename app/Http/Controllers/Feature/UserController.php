<?php

namespace App\Http\Controllers\Feature;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get user info
     *
     * @param Illuminate\Http\Request $request
     * @return string
     */
    public function getUser(Request $request)
    {
        return auth()->user();
    }
}
