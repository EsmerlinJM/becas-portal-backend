<?php

namespace App\Exceptions;

use App\Tools\ResponseCodes;
use Exception;

class CantClose extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Convocatoria no puede ser cerrada'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}