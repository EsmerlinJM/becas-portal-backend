<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AuthController;

use App\Tools\ResponseCodes;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return response()->json(['status' => 'error', 'message' => 'Unauthorised'], ResponseCodes::UNAUTHORIZED);

});

Route::fallback(function () {
    return response()->json(['status' => 'error', 'message' => 'Incorrect Route'], ResponseCodes::NOT_FOUND);
});


// Route::get('/email/verify', function () {
//     return response()->json(['status' => 'error', 'message' => 'Email no ha sido verificado'], ResponseCodes::VALIDATON_ERROR);
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return response()->json(['status' => 'successful', 'message' => 'Email ha sido verificado'], ResponseCodes::OK);
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
//     return response()->json(['status' => 'successful', 'message' => 'Email de verificacion ha sido enviado'], ResponseCodes::OK);
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Route::post('/profile/login', [AuthController::class, 'login'])->name('login');