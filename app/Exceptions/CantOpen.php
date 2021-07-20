<?php

namespace App\Exceptions;

use Exception;
use App\Tools\ResponseCodes;

class CantOpen extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Convocatoria no puede ser abierta'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}
