<?php

use Illuminate\Support\Facades\Route;
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