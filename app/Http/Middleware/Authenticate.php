<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Tools\ResponseCodes;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // return response()->json(['status' => 'error', 'message' => 'No Autenticado'], ResponseCodes::UNPROCESSABLE_ENTITY);
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}