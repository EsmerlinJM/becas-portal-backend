<?php

namespace App\Exceptions;
use App\Tools\ResponseCodes;

use Exception;

class AlreadyUnpublished extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Convocatoria no se encuentra publicada'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}
