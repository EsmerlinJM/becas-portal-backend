<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\ConvocatoriaDetail;
use Illuminate\Http\Request;

use App\Http\Resources\ScheduleResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horarios = Schedule::all();
        try {
            return ScheduleResource::collection($horarios);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'modality' => 'required',
            'shift' => 'required',
            'days' => 'required',
            'time' => 'required',
        ]);

        try {
            $horario = new Schedule;
            $horario->modality = $request->modality;
            $horario->shift = $request->shift;
            $horario->days = $request->days;
            $horario->time = $request->time;
            $horario->active = 1; //Activo por defecto
            $horario->save();

            return new ScheduleResource($horario);
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
            'schedule_id' => 'required',
        ]);

        $horario = Schedule::findOrFail($request->schedule_id);

        try {
            return new ScheduleResource($horario);
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
            'schedule_id' => 'required',
            'modality' => 'required',
            'shift' => 'required',
            'days' => 'required',
            'time' => 'required',
        ]);

        $horario = Schedule::findOrFail($request->schedule_id);

        try {
            $horario->modality = $request->modality;
            $horario->shift = $request->shift;
            $horario->days = $request->days;
            $horario->time = $request->time;
            $horario->save();
            return new ScheduleResource($horario);
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
    public function activate(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required',
        ]);

        $horario = Schedule::findOrFail($request->schedule_id);

            if($horario->active) {
                throw new AlreadyActive;
            } else {
                try {
                    $horario->active = 1; //Activamos
                    $horario->save();
                    return new ScheduleResource($horario);
                } catch (\Throwable $th) {
                    throw new SomethingWentWrong($th);
                }
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required',
        ]);

        $horario = Schedule::findOrFail($request->schedule_id);

            if(!$horario->active) {
                throw new AlreadyDeActivated;
            } else {
                try {
                    $horario->active = 0; //Desactivamos
                    $horario->save();
                    return new ScheduleResource($horario);
                } catch (\Throwable $th) {
                    throw new SomethingWentWrong($th);
                }
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $requestt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required',
        ]);

        $horario = Schedule::findOrFail($request->schedule_id);

        if(ConvocatoriaDetail::where('schedule_id',$horario->id)->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $horario->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}