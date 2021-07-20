<?php

namespace App\Exceptions;
use App\Tools\ResponseCodes;

use Exception;

class ArrayEmpty extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Array vacio o no posee los key-pair esperados'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}
