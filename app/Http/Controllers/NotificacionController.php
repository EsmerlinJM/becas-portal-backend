<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;

use App\Http\Resources\NotificacionResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\NotBelongsTo;
use App\Tools\Tools;
use Carbon\Carbon;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $models = Notificacion::where('user_id', auth()->user()->id)->get();
            return NotificacionResource::collection($models);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->validate([
            'notificacion' => 'required',
        ]);

        $model = Notificacion::findOrFail($request->notificacion);

        $this->belongsToUser($model);

        try {
            return new NotificacionResource($model);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'notificacion' => 'required',
        ]);

        $model = Notificacion::findOrFail($request->notificacion);

        $this->belongsToUser($model);

        try {
            $model->read ? $model->read = false : $model->read = true;
            $model->save();
            return new NotificacionResource($model);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'notificacion' => 'required',
        ]);

        $model = Notificacion::findOrFail($request->notificacion);

        $this->belongsToUser($model);

        try {
            $model->delete();
            return Tools::deleted();
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    public static function belongsToUser(Notificacion $notificacion)
    {
        if ( auth()->user()->id == $notificacion->user->id) {
            return true;
        } else {
            throw new NotBelongsTo;
        }
    }
}