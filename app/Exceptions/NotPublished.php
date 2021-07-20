<?php

namespace App\Exceptions;

use App\Tools\ResponseCodes;
use Exception;

class NotPublished extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Convocatoria no ha sido publicada'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}
