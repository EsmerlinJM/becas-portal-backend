<?php

namespace App\Exceptions;

use App\Tools\ResponseCodes;
use Exception;

class BecaInactiva extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Becado no esta activo'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}
