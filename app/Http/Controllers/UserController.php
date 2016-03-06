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
            'messages' => [
                'The credentials you provided are invalid'
            ]
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::guard('api')->user();

        if ($user->updateInfo($request)) {
            return response()->json([
                'code' => 200,
                'messages' => [
                    'Profile was updated successfully'
                ]
            ]);
        } else {
            return response()->json([
                'code' => 500,
                'messages' => [
                    'An error occurred'
                ]
            ], 500);
        }
    }
}
