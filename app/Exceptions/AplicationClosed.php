<?php

namespace App\Exceptions;

use Exception;
use App\Tools\ResponseCodes;

class AplicationClosed extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Solicitud ya ha sido cerrada'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}