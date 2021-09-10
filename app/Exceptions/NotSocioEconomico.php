<?php

namespace App\Exceptions;

use Exception;
use App\Tools\ResponseCodes;

class NotSocioEconomico extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'No posee datos socio economicos'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}