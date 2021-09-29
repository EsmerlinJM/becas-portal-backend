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

use App\Tools\GoogleBucketTrait;

class ProfileController extends Controller
{

    use GoogleBucketTrait;

    function getProfile(){
        try {
            $user = auth()->user();

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
        //Image Handling
        $image = $this->upload($request, 'image');

        //Tomamos el Usuario Actual
        $user = auth()->user();

        if($this->isProfileUser($user)) {
            //Profile
            $request->validate([
                'name' => 'required',
                'contact_phone' => 'required',
                'contact_email' => 'required',
            ]);

            try {
                $profile = Profile::where('user_id', $user->id)->first();
                if($profile) {
                    if(isset($request->image)) {
                        $profile->image_url = $image['url'];
                        $profile->image_ext = $image['ext'];
                        $profile->image_size = $image['size'];
                    }
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


        } elseif($this->isEvaluador($user)) {

            try {
                $evaluator = Evaluator::where('user_id', $user->id)->first();
                if($evaluator) {
                    if(isset($request->image)) {
                        $evaluator->image_url = $image['url'];
                        $evaluator->image_ext = $image['ext'];
                        $evaluator->image_size = $image['size'];
                    }
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


        } elseif($this->isCoordinador($user)) {
            try {
                $coordinator = Coordinator::where('user_id', $user->id)->first();
                if($coordinator) {
                    if(isset($request->image)) {
                        $coordinator->image_url = $image['url'];
                        $coordinator->image_ext = $image['ext'];
                        $coordinator->image_size = $image['size'];
                    }
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

        } elseif($this->isCandidato($user)) {
            $request->validate([
                'name' => 'required',
                'last_name' => 'required',
                'genero' => 'required',
                'country_id' => 'required',
            ]);

            try {
                $candidate = Candidate::where('user_id', $user->id)->first();
                if($candidate) {
                    $candidate->country_id = $request->country_id;
                    $candidate->province_id = $request->province_id;
                    $candidate->municipality_id = $request->municipality_id;
                    $candidate->address = $request->address;
                    if(isset($request->image)) {
                        $candidate->image_url = $image['url'];
                        $candidate->image_ext = $image['ext'];
                        $candidate->image_size = $image['size'];
                    }
                    $candidate->document_id = $request->document_id;
                    $candidate->name = $request->name;
                    $candidate->last_name = $request->last_name;
                    $candidate->genero = $request->genero;
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

    //Metodo para actualizar usuario
    function updatePicture(Request $request)
    {
        //Image Handling
        $image = $this->upload($request, 'image');

        //Tomamos el Usuario Actual
        $user = auth()->user();

        if(isProfileUser($user)) {
            //Profile
            try {
                $profile = Profile::where('user_id', $user->id)->first();
                if($profile) {
                    $profile->image_url = $image['url'];
                    $profile->image_ext = $image['ext'];
                    $profile->image_size = $image['size'];
                    $profile->save();
                    return new ProfileUserResource($user);
                } else {
                    throw new NotProfile;
                }

            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } elseif($this->isEvaluador($user)) {

            try {
                $evaluator = Evaluator::where('user_id', $user->id)->first();
                if($evaluator) {
                    $evaluator->image_url = $image['url'];
                    $evaluator->image_ext = $image['ext'];
                    $evaluator->image_size = $image['size'];
                    $evaluator->save();
                    return new ProfileEvaluatorResource($evaluator);
                } else {
                    throw new NotProfile;
                }
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }


        } elseif($this->isCoordinador($user)) {
            try {
                $coordinator = Coordinator::where('user_id', $user->id)->first();
                if($coordinator) {
                    $coordinator->image_url = $image['url'];
                    $coordinator->image_ext = $image['ext'];
                    $coordinator->image_size = $image['size'];
                    $coordinator->save();
                    return new ProfileCoordinatorResource($coordinator);
                } else {
                    throw new NotProfile;
                }
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }

        } elseif($this->isCandidato($user)) {
            try {
                $candidate = Candidate::where('user_id', $user->id)->first();
                if($candidate) {
                    $candidate->image_url = $image['url'];
                    $candidate->image_ext = $image['ext'];
                    $candidate->image_size = $image['size'];
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
                return response()->json(['status' => 'successful','message' => 'Contraseña cambiada correctamente'], ResponseCodes::OK);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Contraseña actual incorrecta'], ResponseCodes::UNAUTHORIZED);
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