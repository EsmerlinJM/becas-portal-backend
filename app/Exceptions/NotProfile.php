<?php

namespace App\Exceptions;

use Exception;
use App\Tools\ResponseCodes;

class NotProfile extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Usuario no posee profile, puede ser evaluador, coordinador o candidato'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}