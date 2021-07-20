<?php

namespace App\Exceptions;

use Exception;
use App\Tools\ResponseCodes;

class ConvocatoriaClosed extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'La Convocatoria ya ha cerrado'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}