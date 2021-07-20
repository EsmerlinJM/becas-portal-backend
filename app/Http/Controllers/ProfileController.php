<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

use Hash;
use App\Tools\ResponseCodes;
use App\Http\Resources\UserResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class ProfileController extends Controller
{

    function getProfile(){
        try {
            $user = auth()->user();
            return new UserResource($user);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }


    //Metodo para actualizar usuario
    function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contact_phone' => 'required',
            'contact_email' => 'required',
        ]);

        try {
            $user = auth()->user();
            $profile = Profile::where('user_id', $user->id)->first();
            $profile->name = $request->name;
            $profile->contact_phone = $request->contact_phone;
            $profile->contact_email = $request->contact_email;
            $profile->save();
            return new UserResource($user);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
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