<?php

namespace App\Exceptions;

use App\Tools\ResponseCodes;
use Exception;

class RatingOverFlow extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Calificacion es superior al rango maximo'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}