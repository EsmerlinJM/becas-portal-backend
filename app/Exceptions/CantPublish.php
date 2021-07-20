<?php

namespace App\Exceptions;

use App\Tools\ResponseCodes;
use Exception;

class CantPublish extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Convocatoria no puede ser publicada'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}