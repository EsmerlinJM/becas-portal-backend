<?php

namespace App\Exceptions;
use App\Tools\ResponseCodes;

use Exception;

class AlreadyPublished extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Convocatoria ya se encuentra publicada'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}