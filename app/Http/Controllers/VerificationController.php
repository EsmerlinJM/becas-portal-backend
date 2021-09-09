<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Tools\ResponseCodes;
use App\Notifications\NewPasswordNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Password;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use DB;
use Mail;
use Hash;

use Illuminate\Support\Str;

class VerificationController extends Controller
{
    public function verify($user_id, Request $request) {
        if (!$request->hasValidSignature()) {
            return response()->json(['status' => 'error' ,'message' => 'Url invalida o expirada'], ResponseCodes::UNPROCESSABLE_ENTITY);
        }

        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            if(env('LADING_AFTER_EMAIL_CONFIRMATION')) {
                return redirect(env('LADING_AFTER_EMAIL_CONFIRMATION'));
            } else {
                return response()->json(['status' => 'successful' ,'message' => 'Email ha sido verificado'], ResponseCodes::OK);
            }
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


    public function forgot(Request $request) {
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);

          $status = Password::sendResetLink(
            $request->only('email')
        );

        return response()->json(['status' => 'successful' ,'message' => 'Email reestablecimiento de contraseña enviado'], ResponseCodes::OK);
    }

    public function reset(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users',
            'token' => 'required'
        ]);

        $reset = DB::table('password_resets')->where(['email' => $request->email])->first();

        if(!$reset) {
            return redirect(env('LADING_AFTER_TOKEN_EXPIRED'));
        }

        $valid = Hash::check($request->token, $reset->token);

        if($valid) {
            $user = User::whereEmail($request->email)->first();
            $password = str_random(8);

            $user->password = bcrypt($password);
            $user->save();

            $user->notify(new NewPasswordNotification($password));

            DB::table('password_resets')->where(['email'=> $request->email])->delete();
            return redirect(env('LADING_AFTER_PASSWORD_RESET'));
        } else {
            return redirect(env('LADING_AFTER_TOKEN_EXPIRED'));
        }
    }

}
