<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Aplication;
use App\Models\Convocatoria;
use App\Models\Audience;
use Illuminate\Http\Request;

use App\Http\Resources\ConvocatoriaResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\CantPublish;
use App\Exceptions\CantOpen;
use App\Exceptions\CantPending;
use App\Exceptions\NotPlublished;
use App\Exceptions\AplicationNotClosed;
use App\Tools\Tools;
use Carbon\Carbon;

class ConvocatoriaController extends Controller
{
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
    public function publicadas()
    {

        try {
            $convocatorias = Convocatoria::where('status','Publicada')->get();
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
        User::isAdmin();

        $request->validate([
            'coordinator_id' => 'required',
            'convocatoria_type_id' => 'required',
            'evaluation_id' => 'required',
            'formulario_id' => 'required',
            'audience_id' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        // Initialize Google Storage
        $disk = \Storage::disk('google');


        Audience::findOrFail($request->audience_id); //Valido si la audiencia existe

        try {

            //Image Handling
        if (isset($request->image)) {
            $fileName = strtoupper('PNB-'.Carbon::now()->format('Y-m-d')."-".time().".".$request->file('image')->getClientOriginalExtension());
            $disk->write($fileName, file_get_contents($request->file('image')), ['visibility' => 'public']);
            $image = array(
                "url" => $disk->url($fileName),
                "ext" => $request->file('image')->getClientOriginalExtension(),
                "size" => $request->file('image')->getSize(),
            );
        } else {
            $image = array(
                "url" => null,
                "ext" => null,
                "size" => null,
            );
        }

            $convocatoria = new Convocatoria;
            $convocatoria->coordinator_id = $request->coordinator_id;
            $convocatoria->convocatoria_type_id = $request->convocatoria_type_id;
            $convocatoria->audience_id = $request->audience_id;
            $convocatoria->evaluation_id = $request->evaluation_id;
            $convocatoria->formulario_id = $request->formulario_id;
            $convocatoria->name = $request->name;
            $convocatoria->start_date = Carbon::parse($request->start_date);
            $convocatoria->end_date = Carbon::parse($request->end_date);
            $convocatoria->status = 'Pendiente';
            $convocatoria->image_url = $image['url'];
            $convocatoria->image_ext = $image['ext'];
            $convocatoria->image_size = $image['size'];
            $convocatoria->save();

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
            return new ConvocatoriaResource($convocatoria);
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
        User::isAdmin();

        $request->validate([
            'coordinator_id' => 'required',
            'convocatoria_id' => 'required',
            'evaluation_id' => 'required',
            'formulario_id' => 'required',
            'convocatoria_type_id' => 'required',
            'audience_id' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        // Initialize Google Storage
        $disk = \Storage::disk('google');

        $convocatoria = Convocatoria::findOrFail($request->convocatoria_id);

        try {

                //Image Handling
        if (isset($request->image)) {
            $fileName = strtoupper('PNB-'.Carbon::now()->format('Y-m-d')."-".time().".".$request->file('image')->getClientOriginalExtension());
            $disk->write($fileName, file_get_contents($request->file('image')), ['visibility' => 'public']);
            $image = array(
                "url" => $disk->url($fileName),
                "ext" => $request->file('image')->getClientOriginalExtension(),
                "size" => $request->file('image')->getSize(),
            );
        } else {
            $image = array(
                "url" => $convocatoria->image_url,
                "ext" => $convocatoria->image_ext,
                "size" => $convocatoria->image_size,
            );
        }
            $convocatoria->coordinator_id = $request->coordinator_id;
            $convocatoria->convocatoria_type_id = $request->convocatoria_type_id;
            $convocatoria->audience_id = $request->audience_id;
            $convocatoria->evaluation_id = $request->evaluation_id;
            $convocatoria->formulario_id = $request->formulario_id;
            $convocatoria->name = $request->name;
            $convocatoria->start_date = Carbon::parse($request->start_date);
            $convocatoria->end_date = Carbon::parse($request->end_date);
            $convocatoria->image_url = $image['url'];
            $convocatoria->image_ext = $image['ext'];
            $convocatoria->image_size = $image['size'];
            $convocatoria->save();

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
    public function open(Request $request)
    {
        User::isAdmin();

        $request->validate([
            'convocatoria_id' => 'required',
        ]);



        $convocatoria = Convocatoria::findOrFail($request->convocatoria_id);


            if($convocatoria->status == 'Pendiente') {
                try {
                    $convocatoria->status = "Abierta"; //Abrimos
                    $convocatoria->save();
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
    public function standby(Request $request)
    {
        User::isAdmin();

        $request->validate([
            'convocatoria_id' => 'required',
        ]);

        $convocatoria = Convocatoria::findOrFail($request->convocatoria_id);


            if($convocatoria->status == 'Abierta') {
                try {
                    $convocatoria->status = "Pendiente"; //Abrimos
                    $convocatoria->save();
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
    public function publish(Request $request)
    {
        User::isAdmin();

        $request->validate([
            'convocatoria_id' => 'required',
        ]);

        $convocatoria = Convocatoria::findOrFail($request->convocatoria_id);


            if($convocatoria->status == 'Abierta') {
                foreach ($convocatoria->aplications as $aplication) {
                    if(!$aplication->closed) {
                        throw new AplicationNotClosed;
                    }
                }
                try {
                    $convocatoria->status = 'Publicada'; //Publicamos
                    $convocatoria->save();
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
    public function unpublish(Request $request)
    {
        User::isAdmin();

        $request->validate([
            'convocatoria_id' => 'required',
        ]);

        $convocatoria = Convocatoria::findOrFail($request->convocatoria_id);

            if($convocatoria->status == 'Publicada') {
                try {
                    $convocatoria->status = 'Abierta'; //Despublicamos
                    $convocatoria->save();
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
    public function destroy(Request $request)
    {
        User::isAdmin();

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
                $convocatoria->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}
