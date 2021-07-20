<?php

namespace App\Exceptions;

use Exception;
use App\Tools\ResponseCodes;

class CantPending extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Convocatoria no puede ser pasada a pendiente'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}
