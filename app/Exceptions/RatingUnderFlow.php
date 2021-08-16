<?php

namespace App\Exceptions;

use App\Tools\ResponseCodes;
use Exception;

class RatingUnderFlow extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Calificacion es inferior al rango minimo'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}