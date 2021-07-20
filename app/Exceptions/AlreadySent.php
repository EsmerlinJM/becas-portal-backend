<?php

namespace App\Exceptions;
use App\Tools\ResponseCodes;

use Exception;

class AlreadySent extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Solicitud ya ha sido enviada a evaluacion'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}