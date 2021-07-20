<?php

namespace App\Exceptions;

use Exception;
use App\Tools\ResponseCodes;

class NotPermissions extends Exception
{
    public function render()
    {
        return response()->json(['status' => 'error', 'message' => 'Usuario no posee permisos'], ResponseCodes::UNAUTHORIZED);
    }
}