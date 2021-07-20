<?php

namespace App\Exceptions;

use Exception;
use App\Tools\ResponseCodes;

class NotCandidate extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Usuario no es un candidato'], ResponseCodes::UNAUTHORIZED);
    }
}