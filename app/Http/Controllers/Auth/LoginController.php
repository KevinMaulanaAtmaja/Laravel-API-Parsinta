<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!$token = auth()->attempt($request->only('username', 'password'))) {
            return response(null, 401);
        }
        return response()->json(['token' => $token]);
    }
}
