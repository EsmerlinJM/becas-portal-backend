<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Candidate;
use Illuminate\Http\Request;

use App\Http\Resources\UserResource;
use App\Http\Resources\ProfileUserResource;
use App\Http\Resources\RegisterResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\EmailNotValid;
use App\Tools\ResponseCodes;
use Illuminate\Auth\Events\Registered;

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

        try {
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
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }

        // $accessToken = $user->createToken('authToken')->accessToken;

        try {
            event(new Registered($user));
        } catch (\Throwable $th) {
                $candidate->forceDelete();
                $user->forceDelete();
                throw new EmailNotValid;
        }

        return response([ 'user' => new RegisterResource($user), 'status' => 'Por favor verificar su email'], ResponseCodes::OK);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['status' => 'error', 'message' => 'Credenciales Invalidas'], ResponseCodes::UNAUTHORIZED);
        }

        $user = auth()->user();

        if ($user->hasVerifiedEmail()) {

            $accessToken = auth()->user()->createToken(env('TOKEN_SECRET'))->accessToken;
            return response(['user' => new ProfileUserResource($user), 'access_token' => $accessToken], ResponseCodes::OK);
        } else {
            return response(['status' => 'error' ,'message' => 'El email no ha sido verificado, por favor verificar su email'], ResponseCodes::UNPROCESSABLE_ENTITY);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['status' => 'ok','message' => 'Usuario has sido deslogeado del sistema'], ResponseCodes::OK);
    }


}