<?php

namespace App\Tools;

use Illuminate\Support\Str;
use App\Models\Notificacion;
use App\Models\User;
use Illuminate\Http\Request;



trait NotificacionTrait
{
    public function notificar(User $user, $nombre, $descripcion)
    {
        $notificacion = new Notificacion();
        $notificacion->user_id = $user->id;
        $notificacion->name = $nombre;
        $notificacion->description = $descripcion;
        $notificacion->save();

        return $notificacion;
    }

}
