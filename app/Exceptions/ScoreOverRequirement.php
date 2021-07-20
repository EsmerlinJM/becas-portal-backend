<?php

namespace App\Exceptions;

use Exception;
use App\Tools\ResponseCodes;

class ScoreOverRequirement extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Valor suministrado es superior al esperado'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}