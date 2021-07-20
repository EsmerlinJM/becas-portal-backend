<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Candidate;
use App\Tools\ResponseCodes;
use App\Http\Resources\UserResource;
use App\Http\Resources\RegisterResource;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User();
        $user->role_id = 6; //Usuario
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $candidate = new Candidate();
        $candidate->user_id = $user->id;
        $candidate->country_id = '62';
        $candidate->province_id = '1';
        $candidate->municipality_id = '1';
        $candidate->name = $request->name;
        $candidate->last_name = $request->last_name;
        $candidate->save();

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => new RegisterResource($user), 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['status' => 'error', 'message' => 'Invalid Credentials'], ResponseCodes::UNAUTHORIZED);
        }

        $user = auth()->user();

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => new UserResource($user), 'access_token' => $accessToken], ResponseCodes::OK);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['status' => 'ok','message' => 'User has been logged out'], ResponseCodes::OK);
    }


}