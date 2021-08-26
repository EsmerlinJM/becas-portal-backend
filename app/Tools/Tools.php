<?php


namespace App\Tools;

class Tools
{

    //Status Solicitudes
    const SOLICITUD_INICIADA = 1;
    const PROCESO_EVALUACION = 2;
    const PROCESO_REVISION = 3;
    const PRESELECCIONADO = 4;
    const INCOMPLETO = 5;
    const APROBADO = 6;
    const APROBADO_PRIORIDAD_ALTA = 7;
    const DECLINADO = 8;
    const SOLICITUD_CANCELADA_POR_CANDIDATO = 9;

    //Roles Usuarios
    const ADMIN = 1;
    const EVALUADOR = 2;
    const COORDINADOR = 3;
    const INSTITUCION = 4;
    const OFERTANTE = 5;
    const USUARIO = 6;

    public static function onProcess()
    {
        return response()->json(['status' => 'successful', 'message' => 'Request on Process'], ResponseCodes::OK);
    }

    public static function notAllowed()
    {
        return response()->json(['status' => 'error', 'message' => 'No puede ser borrado, se encuentra en uso'], ResponseCodes::UNPROCESSABLE_ENTITY);
    }

    public static function deleted()
    {
        return response()->json(['status' => 'successful', 'message' => 'Recurso borrado'], ResponseCodes::ACCEPTED);
    }

}