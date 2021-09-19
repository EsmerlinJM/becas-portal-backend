<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aplication;
use App\Models\Convocatoria;
use App\Models\Audience;
use App\Models\Candidate;
use Illuminate\Http\Request;

use App\Http\Resources\ConvocatoriaResource;
use App\Http\Resources\ConvocatoriaOneResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\CantClose;
use App\Exceptions\CantOpen;
use App\Exceptions\CantPending;
use App\Exceptions\CantPublish;
use App\Exceptions\NotPublished;
use App\Exceptions\AplicationNotClosed;
use App\Tools\Tools;
use Carbon\Carbon;

use App\Jobs\NotificarPublicacionBecados;
use App\Jobs\NotificarNuevaConvocatoria;
use App\Jobs\NotificarCierreConvocatoria;


use App\Tools\GoogleBucketTrait;
use App\Tools\NotificacionTrait;

class ConvocatoriaController extends Controller
{

    use NotificacionTrait;
    use GoogleBucketTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $convocatorias = Convocatoria::all();
            return ConvocatoriaResource::collection($convocatorias);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function portal()
    {

        try {
            $convocatorias = Convocatoria::where('status','!=','Pendiente')->get();
            return ConvocatoriaResource::collection($convocatorias);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendientes()
    {

        try {
            $convocatorias = Convocatoria::where('status','Pendiente')->get();
            return ConvocatoriaResource::collection($convocatorias);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function abiertas()
    {

        try {
            $convocatorias = Convocatoria::where('status','Abierta')->get();
            return ConvocatoriaResource::collection($convocatorias);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cerradas()
    {

        try {
            $convocatorias = Convocatoria::where('status','Cerrada')->get();
            return ConvocatoriaResource::collection($convocatorias);
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
            'coordinator_id' => 'required',
            'convocatoria_type_id' => 'required',
            'mensajes_id' => 'required',
            'evaluation_id' => 'required',
            'audience_id' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);


        Audience::findOrFail($request->audience_id); //Valido si la audiencia existe

        try {

            //Image Handling
            $image = $this->upload($request, "image");

            $convocatoria = new Convocatoria;
            $convocatoria->coordinator_id = $request->coordinator_id;
            $convocatoria->mensajes_convocatoria_id = $request->mensajes_id;
            $convocatoria->convocatoria_type_id = $request->convocatoria_type_id;
            $convocatoria->audience_id = $request->audience_id;
            $convocatoria->evaluation_id = $request->evaluation_id;
            $convocatoria->name = $request->name;
            $convocatoria->start_date = Carbon::parse($request->start_date);
            $convocatoria->end_date = Carbon::parse($request->end_date);
            $convocatoria->status = 'Pendiente';
            $convocatoria->image_url = $image['url'];
            $convocatoria->image_ext = $image['ext'];
            $convocatoria->image_size = $image['size'];
            $convocatoria->save();


            $this->notificarAdmin("Han creado una convocatoria", "El usuario: ". auth()->user()->profile->name . ", ha agregado la nueva convocatoria: ".$convocatoria->name);

            return new ConvocatoriaResource($convocatoria);

        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Convocatoria  $convocatoria
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->validate([
            'convocatoria_id' => 'required',
        ]);

        $convocatoria = Convocatoria::findOrFail($request->convocatoria_id);

        try {
            return new ConvocatoriaOneResource($convocatoria);
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
            'coordinator_id' => 'required',
            'convocatoria_id' => 'required',
            'evaluation_id' => 'required',
            'mensajes_id' => 'required',
            'convocatoria_type_id' => 'required',
            'audience_id' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $convocatoria = Convocatoria::findOrFail($request->convocatoria_id);

        try {

            //Image Handling
            $image = $this->upload($request, "image");

            $convocatoria->coordinator_id = $request->coordinator_id;
            $convocatoria->convocatoria_type_id = $request->convocatoria_type_id;
            $convocatoria->mensajes_convocatoria_id = $request->mensajes_id;
            $convocatoria->audience_id = $request->audience_id;
            $convocatoria->evaluation_id = $request->evaluation_id;
            $convocatoria->name = $request->name;
            $convocatoria->start_date = Carbon::parse($request->start_date);
            $convocatoria->end_date = Carbon::parse($request->end_date);
            if (isset($request->image)) {
                $convocatoria->image_url = $image['url'];
                $convocatoria->image_ext = $image['ext'];
                $convocatoria->image_size = $image['size'];
            }
            $convocatoria->save();

            $this->notificarAdmin("Han realizado cambios a una convocatoria", "El usuario: ". auth()->user()->profile->name . ", ha realizado cambios a la convocatoria: ".$convocatoria->name);

            return new ConvocatoriaResource($convocatoria);

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
    public function setOpen(Request $request)
    {
        $request->validate([
            'convocatoria_id' => 'required',
        ]);

        $convocatoria = Convocatoria::findOrFail($request->convocatoria_id);

        if($convocatoria->status == 'Pendiente') {
            try {
                $convocatoria->status = "Abierta"; //Abrimos
                $convocatoria->save();

                //Notificar a los Candidatos de que hay una nueva convocatoria disponible
                NotificarNuevaConvocatoria::dispatch($convocatoria);

                $this->notificarAdmin("Convocatoria disponible", "Esta disponible para solicitudes la convocatoria ".$convocatoria->name);

                return new ConvocatoriaResource($convocatoria);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            throw new CantOpen;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setPublished(Request $request)
    {
        $request->validate([
            'convocatoria_id' => 'required',
        ]);

        $convocatoria = Convocatoria::findOrFail($request->convocatoria_id);

            if($convocatoria->status == 'Cerrada') {
                try {
                    $convocatoria->published = true; //Publicamos
                    $convocatoria->save();

                    NotificarPublicacionBecados::dispatch($convocatoria);

                    $this->notificarAdmin("Publicacion resultados", "Se han publicado los resultados de la convocatoria ".$convocatoria->name);

                    return new ConvocatoriaResource($convocatoria);
                } catch (\Throwable $th) {
                    throw new SomethingWentWrong($th);
                }
            } else {
                throw new CantPublish;
            }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setUnPublished(Request $request)
    {
        $request->validate([
            'convocatoria_id' => 'required',
        ]);

        $convocatoria = Convocatoria::findOrFail($request->convocatoria_id);

            if($convocatoria->status == 'Cerrada' && $convocatoria->published == true) {
                try {
                    $convocatoria->published = false; //Publicamos
                    $convocatoria->save();

                    $this->notificarAdmin("Cambios en convocatoria", "Se ha cambiado el estado a la convocatoria ".$convocatoria->name);

                    return new ConvocatoriaResource($convocatoria);
                } catch (\Throwable $th) {
                    throw new SomethingWentWrong($th);
                }
            } else {
                throw new NotPublished;
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setPending(Request $request)
    {
        $request->validate([
            'convocatoria_id' => 'required',
        ]);

        $convocatoria = Convocatoria::findOrFail($request->convocatoria_id);

        if($convocatoria->status == 'Abierta') {
            try {
                $convocatoria->status = "Pendiente"; //Ponemos pendiente
                $convocatoria->save();

                $this->notificarAdmin("Cambios en convocatoria", "Se ha cambiado el estado a la convocatoria ".$convocatoria->name);

                return new ConvocatoriaResource($convocatoria);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            throw new CantPending;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setClose(Request $request)
    {

        $request->validate([
            'convocatoria_id' => 'required',
        ]);

        $convocatoria = Convocatoria::findOrFail($request->convocatoria_id);

            if($convocatoria->status == 'Abierta') {
                try {
                    $convocatoria->status = 'Cerrada'; //Cerramos
                    $convocatoria->save();

                //Notificar a los Candidatos
                NotificarCierreConvocatoria::dispatch($convocatoria);

                $this->notificarAdmin("Cierre convocatoria", "La convocatoria: ".$convocatoria->name." se ha cerrado y no recibirá más solicitudes.");

                    return new ConvocatoriaResource($convocatoria);
                } catch (\Throwable $th) {
                    throw new SomethingWentWrong($th);
                }
            } else {
                throw new CantClose;
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
            'convocatoria_id' => 'required',
        ]);

        $convocatoria = Convocatoria::findOrFail($request->convocatoria_id);

        if($convocatoria->details->count() > 0) {
            return Tools::notAllowed();
        } elseif(Aplication::where('convocatoria_id', $convocatoria->id)->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $this->notificarAdmin("Convocatoria borrada", "Se ha borrado la convocatoria: ".$convocatoria->name);
                $convocatoria->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}
