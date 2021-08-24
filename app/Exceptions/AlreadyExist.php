<?php

namespace App\Exceptions;

use App\Tools\ResponseCodes;
use Exception;

class AlreadyExist extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Ya existe'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}