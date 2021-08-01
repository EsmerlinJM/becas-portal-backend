<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evaluator;
use App\Models\Coordinator;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use Hash;
use App\Tools\ResponseCodes;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResource2;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class UserController extends Controller
{
    // Metodo para traer todos los usuarios
    function index(){
        User::isAdmin();
        try {
            $user = User::all();
            return UserResource2::collection($user);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }

    }

    function show(Request $request){
        $request->validate([
            'user_id'=>'required',
        ]);

        $user = User::findOrFail($request->user_id);
        // return $user;

        try {
            return new UserResource2($user);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    // Metodo para crear usuario
    function store(Request $request)
    {
        User::isAdmin();
        // Validaciones
        $request->validate([
            'email'=>'required|unique:users',
            'name'=>'required',
            'password'=>'required|confirmed',
            'role_id' => 'required',
        ]);

        $role = Role::findOrFail($request->role_id);

        try {
            $user = new User;
            $user->email = $request->email;
            $user->role_id = $role->id;
            $user->password = Hash::make($request->password);
            $user->save();

            event(new Registered($user));

            if ( $role->name == 'Evaluador') {
                //Hacer un Evaluador
                $request->validate([
                    'coordinator_id' => 'required',
                ]);

                $evaluador = new Evaluator;
                $evaluator->user_id = $user->id;
                $evaluador->coordinator_id = $request->coordinator_id;
                $evaluator->name = $request->name;
                $evaluator->contact_phone = "pending";
                $evaluator->contact_email = "pending";
                $evaluator->save();

            } elseif ( $role->name == 'Coordinador') {
                //Hacer un Coordinador
                $coordinador = new Coordinator;
                $coordinador->user_id = $user->id;
                $coordinador->name = $request->name;
                $coordinador->contact_phone = "pending";
                $coordinador->contact_email = "pending";
                $coordinador->save();

            } elseif ( $role->name == 'Usuario') {
                //Hacer un Candidato
                $request->validate([
                    'last_name'=>'required',
                ]);
                $candidate = new Candidate;
                $candidate->user_id = $user->id;
                $candidate->name = $request->name;
                $candidate->last_name = $request->last_name;
                $candidate->country_id = '62';
                $candidate->province_id = '1';
                $candidate->municipality_id = '1';
                $candidate->save();

            } else {
                //Hacer un Profile Normal
                $profile = new Profile;
                $profile->user_id = $user->id;
                $profile->name = $request->name;
                $profile->contact_phone = "pending";
                $profile->contact_email = "pending";
                $profile->save();
            }


            return new UserResource2($user);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    //Metodo para actualizar usuario
    function update(Request $request)
    {
        User::isAdmin();
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
            // $user->role_id = $request->role_id;
            $user->save();
            return new UserResource2($user);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    function resetPassword(Request $request)
    {
        User::isAdmin();
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
}