<?php

namespace App\Exceptions;


use Exception;
use App\Tools\ResponseCodes;

class AplicationNotClosed extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Convocatoria posee solicitudes pendiente de cierre, imposible continuar'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }
}