<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\User;

class LoginController extends Controller
{
    public function signup(Request $request)
    {
        $user = new User();
        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['password'] = bcrypt($request->password);
        $user['remember_token'] = Str::random(60);
        $user['role'] = $request->role;
        $user->save();

        $success['token'] = $user->createToken('zenicms')->accessToken;
        $success['user'] = $user->name;

        return response()->json(['success' => $success]);
    }

    public function login(Request $request)
    {
        $data = $request->only(['email', 'password']);
        if(!Auth::attempt($data))
        {
            return response()->json([
                'message' => 'not found'
            ], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        return response()->json([
            'access_token' => $tokenResult->accessToken,
        ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

}
