<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Tools\ResponseCodes;

class VerificationController extends Controller
{
    public function verify($user_id, Request $request) {
        if (!$request->hasValidSignature()) {
            return response()->json(['status' => 'error' ,'message' => 'Url invalida o expirada'], ResponseCodes::UNPROCESSABLE_ENTITY);
        }

        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            return response()->json(['status' => 'successful' ,'message' => 'Email ha sido verificado'], ResponseCodes::OK);
        } else {
            return response()->json(['status' => 'error' ,'message' => 'Email ya ha sido verificado anteriormente'], ResponseCodes::UNPROCESSABLE_ENTITY);
        }
    }

    public function resend(Request $request) {

        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if($user) {
            if ($user->hasVerifiedEmail()) {
                return response()->json(['status' => 'error' ,'message' => 'Email ya ha sido verificado anteriormente'], ResponseCodes::UNPROCESSABLE_ENTITY);
            }
            $user->sendEmailVerificationNotification();
            return response()->json(['status' => 'successful' ,'message' => 'Vinculo de vericaficacion enviado a su email'], ResponseCodes::OK);

        } else {
            return response()->json(['status' => 'error' ,'message' => 'Email no se encuentra registrado con nosotros'], ResponseCodes::UNPROCESSABLE_ENTITY);
        }
    }
}