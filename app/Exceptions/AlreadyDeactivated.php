<?php

namespace App\Exceptions;
use App\Tools\ResponseCodes;

use Exception;

class AlreadyDeactivated extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Ya se encuentra inactivo'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}