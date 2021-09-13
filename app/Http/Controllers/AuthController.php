<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Candidate;
use App\Models\SocioEconomico;
use Illuminate\Http\Request;

use App\Http\Resources\UserResource;
use App\Http\Resources\ProfileUserResource;
use App\Http\Resources\RegisterResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\EmailNotValid;
use App\Tools\ResponseCodes;
use App\Tools\NotificacionTrait;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{

    use NotificacionTrait;

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

            // return $candidate;

            $economico = new SocioEconomico();
            $economico->candidate_id = $candidate->id;
            $economico->save();

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

        $this->notificar($user, "Bienvenido al Portal Unico de Becas", "¡Hola!  En el portal Beca tu futuro podrás encontrar las ofertas académicas que te ayudarán a desarrollar tu talento y desarrollar el país.");



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


    public function loginCandidato(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['status' => 'error', 'message' => 'Credenciales Invalidas'], ResponseCodes::UNAUTHORIZED);
        }

        $user = auth()->user();

        if($user->candidate) {
            if ($user->hasVerifiedEmail()) {

                $accessToken = auth()->user()->createToken(env('TOKEN_SECRET'))->accessToken;
                return response(['user' => new ProfileUserResource($user), 'access_token' => $accessToken], ResponseCodes::OK);
            } else {
                return response(['status' => 'error' ,'message' => 'El email no ha sido verificado, por favor verificar su email'], ResponseCodes::UNPROCESSABLE_ENTITY);
            }
        } else {
            return response(['status' => 'error' ,'message' => 'Usuario no existe como candidato'], ResponseCodes::UNPROCESSABLE_ENTITY);
        }


    }



}