<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Auth;
use Validator;
use App\User;
use Uuid;

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

    public function getProfile(Request $request)
    {
        $user = Auth::guard('api')->user();

        return response()->json([
            'code' => 200,
            'user_data' => $user->getJSON(),
            'messages' => [
                'Success'
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

    public function newProfile(Request $request)
    {
        $admin_user = Auth::guard('api')->user();

        if ($admin_user->is_admin) {
            if (($user = $this->createUser($request)))  {
                return response()->json([
                    'code' => 200,
                    'user_data' => $user->getJSON(),
                    'message' => ['User created successfully']
                ]);
            } else {
                return response()->json([
                    'code' => 500,
                    'message' => ['An error occurred']
                ], 500);
            }
        } else {
            return response()->json([
                'code' => 403,
                'message' => ['You do not have permission']
            ], 403);
        }
    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), User::$rules);
        if ($validator->fails()) {
            return false;
        } else {
            $uuid = Uuid::generate(4);
            $user = User::create([
               'uuid' => $uuid,
               'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'email' => $request->email,
               'address' => $request->address,
               'password' => bcrypt($request->password),
               'phone' => $request->phone,
               'api_token' => str_random(60)
           ]);

            if ($user != null) {
                return $user;
            } else {
                return false;
            }
        }
    }
}
