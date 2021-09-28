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

    public function notificarAdmin($nombre, $descripcion)
    {

        $admins = User::where('role_id', 1)->get();

        foreach ($admins as $admin) {
            $notificacion = new Notificacion();
            $notificacion->user_id = $admin->id;
            $notificacion->name = $nombre;
            $notificacion->description = $descripcion;
            $notificacion->save();
        }

        return true;
    }

}
