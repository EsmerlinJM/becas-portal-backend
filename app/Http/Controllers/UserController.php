<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Institution;
use App\Models\Offerer;
use App\Models\Profile;
use App\Models\Evaluator;
use App\Models\Coordinator;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use Hash;
use App\Tools\ResponseCodes;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserListResource;
use App\Http\Resources\ProfileUserResource;
use App\Http\Resources\ProfileCandidateResource;
use App\Http\Resources\ProfileEvaluatorResource;
use App\Http\Resources\ProfileCoordinatorResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\EmailNotValid;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class UserController extends Controller
{
    // Metodo para traer todos los usuarios
    function index(){
        try {
            $usuarios = User::where('role_id','!=','6')->get();
            // return UserResource::collection($user);
            return UserListResource::collection($usuarios);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    function show(Request $request){
        $request->validate([
            'user_id'=>'required',
        ]);

        $user = User::findOrFail($request->user_id);

        if($this->isProfileUser($user)) {
            return new ProfileUserResource($user);

        } elseif($this->isEvaluador($user)) {
            $evaluator = Evaluator::where('user_id', $user->id)->first();
            return new ProfileEvaluatorResource($evaluator);

        } elseif($this->isCoordinador($user)) {
            $coordinator = Coordinator::where('user_id', $user->id)->first();
            return new ProfileCoordinatorResource($coordinator);

        } elseif($this->isCandidato($user)) {
            $candidate = Candidate::where('user_id', $user->id)->first();
            return new ProfileCandidateResource($candidate);

        }

        try {
            return new UserResource($user);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }



    // Metodo para crear usuario
    function storeAdmin(Request $request)
    {
        // Validaciones
        $request->validate([
            'email'=>'required|unique:users',
            'name'=>'required',
            'password'=>'required|confirmed',
        ]);

        try {
            $user = new User;
            $user->email = $request->email;
            $user->role_id = 1; //Administrator
            $user->password = Hash::make($request->password);
            $user->save();

            try {
                event(new Registered($user));
            } catch (\Throwable $th) {
                    $user->forceDelete();
                    throw new EmailNotValid;
            }

            //Hacer un Profile Normal
            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->name = $request->name;
            $profile->contact_phone = "pending";
            $profile->contact_email = $user->email;
            $profile->save();

            return new ProfileUserResource($user);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
    }

    // Metodo para crear usuario Institucional
    function storeInstitucion(Request $request)
    {
        // Validaciones
        $request->validate([
            'email'=>'required|unique:users',
            'name'=>'required',
            'institucion'=>'required',
            'password'=>'required|confirmed',
        ]);

        $institucion = Institution::findOrFail($request->institucion);

        try {
            $user = new User;
            $user->email = $request->email;
            $user->role_id = 4; //Role Institucion
            $user->institution_id = $institucion->id; //Institucion
            $user->password = Hash::make($request->password);
            $user->save();

            try {
                event(new Registered($user));
            } catch (\Throwable $th) {
                    $user->forceDelete();
                    throw new EmailNotValid;
            }

            //Hacer un Profile Normal
            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->name = $request->name;
            $profile->contact_phone = "pending";
            $profile->contact_email = $user->email;
            $profile->save();

            return new ProfileUserResource($user);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
    }

    // Metodo para crear usuario Institucional
    function storeOferente(Request $request)
    {
        // Validaciones
        $request->validate([
            'email'=>'required|unique:users',
            'name'=>'required',
            'oferente'=>'required',
            'password'=>'required|confirmed',
        ]);

        $oferente = Offerer::findOrFail($request->oferente);

        try {
            $user = new User;
            $user->email = $request->email;
            $user->role_id = 5; //Role Oferente
            $user->offerer_id = $oferente->id; //Oferente
            $user->password = Hash::make($request->password);
            $user->save();

            try {
                event(new Registered($user));
            } catch (\Throwable $th) {
                    $user->forceDelete();
                    throw new EmailNotValid;
            }

            //Hacer un Profile Normal
            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->name = $request->name;
            $profile->contact_phone = "pending";
            $profile->contact_email = $user->email;
            $profile->save();

            return new ProfileUserResource($user);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
    }

    // Metodo para crear usuario Institucional
    function storeSoloLectura(Request $request)
    {
        // Validaciones
        $request->validate([
            'email'=>'required|unique:users',
            'name'=>'required',
            'password'=>'required|confirmed',
        ]);

        $role = Role::firstOrCreate(
            ['name' => 'lectura'],
            ['description' => 'Role de Solo Lectura']
        );

        try {
            $user = new User;
            $user->email = $request->email;
            $user->role_id = $role->id; //Role de Solo Lectura
            $user->password = Hash::make($request->password);
            $user->save();

            try {
                event(new Registered($user));
            } catch (\Throwable $th) {
                    $user->forceDelete();
                    throw new EmailNotValid;
            }

            //Hacer un Profile Normal
            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->name = $request->name;
            $profile->contact_phone = "pending";
            $profile->contact_email = $user->email;
            $profile->save();

            return new ProfileUserResource($user);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
    }

    //Metodo para actualizar usuario
    function update(Request $request)
    {
        $user = User::findOrFail($request->user_id);

            if($user->email != $request->email) {
                $request->validate([
                    'user_id' => 'required',
                    'email' => 'required|unique:users',
                    // 'role_id' => 'required'
                ]);
            } else {
                $request->validate([
                    'user_id' => 'required',
                    'email' => 'required',
                    // 'role_id' => 'required'
                ]);
            }

        try {
            $user->email = $request->email;
            $user->save();
            return new UserResource($user);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    function resetPassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = User::findOrFail($request->user_id);

        try {
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json(['status' => 'successful' ,'message' => 'Password cambiado correctamente'], ResponseCodes::OK);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    function isProfileUser(User $user)
    {
        if($user->role->id != Tools::EVALUADOR && $user->role->id != Tools::COORDINADOR && $user->role->id != Tools::USUARIO)
        {
            return true;
        } else {
            return false;
        }
    }

    function isEvaluador(User $user)
    {
        if($user->role->id == Tools::EVALUADOR)
        {
            return true;
        } else {
            return false;
        }
    }

    function isCoordinador(User $user)
    {
        if($user->role->id == Tools::COORDINADOR)
        {
            return true;
        } else {
            return false;
        }
    }

    function isCandidato(User $user)
    {
        if($user->role->id == Tools::USUARIO)
        {
            return true;
        } else {
            return false;
        }
    }
}