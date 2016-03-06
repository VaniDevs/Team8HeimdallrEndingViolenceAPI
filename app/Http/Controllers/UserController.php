<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::once(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::User();
                // Authentication passed...
                return response()->json([
                    'code' => 200,
                    'token' => $user->api_token
                ]);
        }
        return response()->json([
            'code' => 401,
            'errors' => [
                'The credentials you provided are invalid'
            ]
        ]);
    }

    public function updateProfile(Request $request)
    {

    }
}
