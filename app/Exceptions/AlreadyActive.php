<?php

namespace App\Exceptions;
use App\Tools\ResponseCodes;

use Exception;

class AlreadyActive extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Ya se encuentra activo'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}