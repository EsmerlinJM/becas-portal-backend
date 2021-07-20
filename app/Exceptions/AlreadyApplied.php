<?php

namespace App\Exceptions;

use Exception;
use App\Tools\ResponseCodes;

class AlreadyApplied extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Ya tienes una solicitud abierta para esta oferta academica'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}
