<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (app()->environment('local')) {

            Log::channel('debugger')->info("====LOG INFO=====");

            Log::channel('debugger')->info("***HEADER***");
            Log::channel('debugger')->info(json_encode($request->header()));
            Log::channel('debugger')->info("***HEADER***");

            Log::channel('debugger')->info('URI: ' .$request->getUri());
            Log::channel('debugger')->info('METHOD: ' .$request->getMethod());
            Log::channel('debugger')->info('REQUEST_BODY: ' .json_encode($request->all()));
            Log::channel('debugger')->info('RESPONSE: ' .$response->getContent());
            Log::channel('debugger')->info('PATH: ' .$request->path());
            Log::channel('debugger')->info('FULL_URL: ' .$request->fullUrl());
            Log::channel('debugger')->info('IP :' .$request->ip());
            Log::channel('debugger')->info('FULL_URL :' .$request->fullUrl());

            Log::channel('debugger')->info("====LOG INFO=====");
        }

        return $response;
    }
}

// "HEADER":{"content-length":["314"],"content-type":["multipart\/form-data; boundary=--------------------------631945006988393447686528"],"connection":["keep-alive"],"accept-encoding":["gzip, deflate, br"],"host":["be-becas.fmt"],"postman-token":["338298e8-402b-49d3-bb69-78a614434b02"],"user-agent":["PostmanRuntime\/7.28.4"],"accept":["application\/json"]}