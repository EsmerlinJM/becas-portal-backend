<?php

namespace App\Exceptions;

use App\Tools\ResponseCodes;
use Exception;

class RatingInferior extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Rango minimo es igual o superior al rango maximo'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}
