<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evaluator;
use App\Models\Coordinator;
use App\Models\Candidate;
use App\Models\Profile;
use Illuminate\Http\Request;

use Hash;
use App\Tools\ResponseCodes;
use App\Http\Resources\ProfileUserResource;
use App\Http\Resources\ProfileEvaluatorResource;
use App\Http\Resources\ProfileCoordinatorResource;
use App\Http\Resources\ProfileCandidateResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Exceptions\NotProfile;
use App\Tools\Tools;
use Carbon\Carbon;

class ProfileController extends Controller
{

    //Roles Usuarios
    // const ADMIN = 1; Profile
    // const EVALUADOR = 2; Evaluador
    // const COORDINADOR = 3; Coordinador
    // const INSTITUCION = 4; Profile
    // const OFERTANTE = 5; Profile
    // const USUARIO = 6; Candidato

    function getProfile(){
        try {
            $user = auth()->user();

            if($user->role->id == Tools::ADMIN || $user->role->id == Tools::INSTITUCION || $user->role->id == Tools::OFERTANTE) {
                return new ProfileUserResource($user);

            } elseif($user->role->id == Tools::EVALUADOR) {
                $evaluator = Evaluator::where('user_id', $user->id)->first();
                return new ProfileEvaluatorResource($evaluator);

            } elseif($user->role->id == Tools::COORDINADOR) {
                $coordinator = Coordinator::where('user_id', $user->id)->first();
                return new ProfileCoordinatorResource($coordinator);

            } elseif($user->role->id == Tools::USUARIO) {
                $candidate = Candidate::where('user_id', $user->id)->first();
                return new ProfileCandidateResource($candidate);

            } else {
                return response()->json(['status' => 'error', 'message' => 'Role de Usuario no reconocido'], ResponseCodes::UNPROCESSABLE_ENTITY);
            }
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }


    //Metodo para actualizar usuario
    function update(Request $request)
    {
        // Initialize Google Storage
        $disk = \Storage::disk('google');

        //Image Handling
        if (isset($request->image)) {
            $fileName = strtoupper('PNB-'.Carbon::now()->format('Y-m-d')."-".time().".".$request->file('image')->getClientOriginalExtension());
            $disk->write($fileName, file_get_contents($request->file('image')), ['visibility' => 'public']);
            $image = array(
                "url" => $disk->url($fileName),
                "ext" => $request->file('image')->getClientOriginalExtension(),
                "size" => $request->file('image')->getSize(),
            );
        } else {
            $image = array(
                "url" => null,
                "ext" => null,
                "size" => null,
            );
        }

        //Tomamos el Usuario Logeado
        $user = auth()->user();

        if($user->role->id == Tools::ADMIN || $user->role->id == Tools::INSTITUCION || $user->role->id == Tools::OFERTANTE) { //Profile

            $request->validate([
                'name' => 'required',
                'contact_phone' => 'required',
                'contact_email' => 'required',
            ]);

            try {
                $profile = Profile::where('user_id', $user->id)->first();
                if($profile) {
                    $profile->image_url = $image['url'];
                    $profile->image_ext = $image['ext'];
                    $profile->image_size = $image['size'];
                    $profile->name = $request->name;
                    $profile->contact_phone = $request->contact_phone;
                    $profile->contact_email = $request->contact_email;
                    $profile->save();
                    return new ProfileUserResource($user);
                } else {
                    throw new NotProfile;
                }

            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }


        } elseif($user->role->id == Tools::EVALUADOR) { //Evaluator

            try {
                $evaluator = Evaluator::where('user_id', $user->id)->first();
                if($evaluator) {
                    $evaluator->image_url = $image['url'];
                    $evaluator->image_ext = $image['ext'];
                    $evaluator->image_size = $image['size'];
                    $evaluator->name = $request->name;
                    $evaluator->contact_phone = $request->contact_phone;
                    $evaluator->contact_email = $request->contact_email;
                    $evaluator->save();
                    return new ProfileEvaluatorResource($evaluator);
                } else {
                    throw new NotProfile;
                }
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }


        } elseif($user->role->id == Tools::COORDINADOR) { //Coordinator
            try {
                $coordinator = Coordinator::where('user_id', $user->id)->first();
                if($coordinator) {
                    $coordinator->image_url = $image['url'];
                    $coordinator->image_ext = $image['ext'];
                    $coordinator->image_size = $image['size'];
                    $coordinator->name = $request->name;
                    $coordinator->contact_phone = $request->contact_phone;
                    $coordinator->contact_email = $request->contact_email;
                    $coordinator->save();
                    return new ProfileCoordinatorResource($coordinator);
                } else {
                    throw new NotProfile;
                }
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }

        } elseif($user->role->id == Tools::USUARIO) {//Candidate
            $request->validate([
                'name' => 'required',
                'last_name' => 'required',
                'country_id' => 'required',
                'province_id' => 'required',
                'municipality_id' => 'required',
            ]);

            try {
                $candidate = Candidate::where('user_id', $user->id)->first();
                if($candidate) {
                    $candidate->country_id = $request->country_id;
                    $candidate->province_id = $request->province_id;
                    $candidate->municipality_id = $request->municipality_id;
                    $candidate->address = $request->address;
                    $candidate->image_url = $image['url'];
                    $candidate->image_ext = $image['ext'];
                    $candidate->image_size = $image['size'];
                    $candidate->document_id = $request->document_id;
                    $candidate->name = $request->name;
                    $candidate->last_name = $request->last_name;
                    $candidate->born_date = $request->born_date ? Carbon::parse($request->born_date) : null;
                    $candidate->contact_phone = $request->contact_phone;
                    $candidate->contact_email = $request->contact_email;
                    $candidate->save();
                    return new ProfileCandidateResource($candidate);
                } else {
                    throw new NotProfile;
                }
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }


        } else {
            return response()->json(['status' => 'error', 'message' => 'Role de Usuario no reconocido'], ResponseCodes::UNPROCESSABLE_ENTITY);
        }

    }


    //Metodo para cambiar la password
    function changePassword(Request $request)
    {

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = User::findOrFail(auth()->user()->id);

        if(Hash::check($request->current_password, $user->password)){
            try {
                $user->password = bcrypt($request->password);
                $user->save();
                return response()->json(['status' => 'successful','message' => 'Password cambiado correctamente'], ResponseCodes::OK);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Password actual incorrecto'], ResponseCodes::UNAUTHORIZED);
        }

    }
}