<?php

namespace App\Http\Controllers;

use App\Models\MensajeCandidato;
use App\Models\MensajeBackOffice;
use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Resources\MensajesCandidatoResource;
use App\Http\Resources\MensajesBackOfficeResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\NotCandidate;
use App\Exceptions\NotBelongsTo;
use App\Exceptions\NotPermissions;
use App\Tools\Tools;

class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = auth()->user();

        if($usuario->candidate) {
            try {
                $mensajes = MensajeCandidato::where('candidate_id', $usuario->candidate->id)->paginate(30);
                return MensajesCandidatoResource::collection($mensajes);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            try {
                $mensajes = MensajeBackOffice::where('user_id', $usuario->id)->paginate(30);
                return MensajesBackOfficeResource::collection($mensajes);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function composeCandidato(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        $usuario = auth()->user();

        $enviar_a = isset($request->usuario) ? User::findOrFail($request->usuario) : User::where('role_id', 3)->get()->random();

        if($usuario->candidate) {
            try {
                //Enviado en el Candidato
                $mensaje = new MensajeCandidato();
                $mensaje->user_id = $enviar_a->id;
                $mensaje->candidate_id = $usuario->candidate->id;
                $mensaje->subject = $request->subject;
                $mensaje->message = $request->message;
                $mensaje->type = "enviado";
                $mensaje->save();

                //Recibido en BackOffices
                $mensaje2 = new MensajeBackOffice();
                $mensaje2->user_id = $enviar_a->id;
                $mensaje2->candidate_id = $usuario->candidate->id;
                $mensaje2->subject = $request->subject;
                $mensaje2->message = $request->message;
                $mensaje2->type = "recibido";
                $mensaje2->save();

                return new MensajesCandidatoResource($mensaje);

            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            throw new NotCandidate();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function composeBackOffice(Request $request)
    {
        $request->validate([
            'candidato' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $usuario = auth()->user();
        $candidato = Candidate::findOrFail($request->candidato);

        if($usuario->candidate) {
            throw new NotPermissions();
        }

        try {
            //Enviado en el BackOffice
            $mensaje = new MensajeBackOffice();
            $mensaje->user_id = $usuario->id;
            $mensaje->candidate_id = $candidato->id;
            $mensaje->subject = $request->subject;
            $mensaje->message = $request->message;
            $mensaje->type = "enviado";
            $mensaje->save();

            //Recibido en Candidato
            $mensaje2 = new MensajeCandidato();
            $mensaje2->user_id = $usuario->id;
            $mensaje2->candidate_id = $candidato->id;
            $mensaje2->subject = $request->subject;
            $mensaje2->message = $request->message;
            $mensaje2->type = "recibido";
            $mensaje2->save();

            return new MensajesBackOfficeResource($mensaje);
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
            'mensaje_id' => 'required',
        ]);

        $usuario = auth()->user();

        if($usuario->candidate) {
            $mensaje = MensajeCandidato::findOrFail($request->mensaje_id);
            $this->belongsToUserCandidato($mensaje);
            try {
                return new MensajesCandidatoResource($mensaje);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            $mensaje = MensajeBackOffice::findOrFail($request->mensaje_id);
            try {
                return new MensajesBackOfficeResource($mensaje);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function setRead(Request $request)
    {
        $request->validate([
            'mensaje_id' => 'required',
        ]);

        $usuario = auth()->user();

        if($usuario->candidate) {
            $mensaje = MensajeCandidato::findOrFail($request->mensaje_id);
            $this->belongsToUserCandidato($mensaje);
            try {
                $mensaje->read = true;
                $mensaje->save();
                return new MensajesCandidatoResource($mensaje);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            $mensaje = MensajeBackOffice::findOrFail($request->mensaje_id);
            try {
                $mensaje->read = true;
                $mensaje->save();
                return new MensajesBackOfficeResource($mensaje);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mensaje  $mensaje
     * @return \Illuminate\Http\Response
     */
    public function setUnRead(Request $request)
    {
        $request->validate([
            'mensaje_id' => 'required',
        ]);

        $usuario = auth()->user();

        if($usuario->candidate) {
            $mensaje = MensajeCandidato::findOrFail($request->mensaje_id);
            $this->belongsToUserCandidato($mensaje);
            try {
                $mensaje->read = false;
                $mensaje->save();
                return new MensajesCandidatoResource($mensaje);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            $mensaje = MensajeBackOffice::findOrFail($request->mensaje_id);
            try {
                $mensaje->read = false;
                $mensaje->save();
                return new MensajesBackOfficeResource($mensaje);
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
    public function destroy(Request $request)
    {
        $request->validate([
            'mensaje_id' => 'required',
        ]);

        $usuario = auth()->user();

        if($usuario->candidate) {
            $mensaje = MensajeCandidato::findOrFail($request->mensaje_id);
            $this->belongsToUserCandidato($mensaje);
            try {
                $mensaje->delete();
                return Tools::deleted();
                return new MensajesCandidatoResource($mensaje);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            $mensaje = MensajeBackOffice::findOrFail($request->mensaje_id);
            $this->belongsToUserBackOffice($mensaje);
            try {
                $mensaje->delete();
                return Tools::deleted();
                return new MensajesBackOfficeResource($mensaje);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }

    public static function belongsToUserCandidato(MensajeCandidato $mensaje)
    {
        $usuario = auth()->user();
        if (auth()->user()->candidate->id == $mensaje->candidato->id) {
            return true;
        } else {
            throw new NotBelongsTo;
        }
    }

    public static function belongsToUserBackOffice(MensajeBackOffice $mensaje)
    {
        $usuario = auth()->user();
        if (auth()->user()->id == $mensaje->usuario->id) {
            return true;
        } else {
            throw new NotBelongsTo;
        }
    }
}