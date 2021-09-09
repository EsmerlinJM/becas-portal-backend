<?php

namespace App\Http\Controllers;

use App\Models\FormacionAcademica;
use App\Models\Candidate;
use Illuminate\Http\Request;

use App\Http\Resources\FormacionAcademicaResourceFull;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\NotCandidate;
use App\Exceptions\NotBelongsTo;
use App\Exceptions\ArrayEmpty;
use App\Tools\Tools;
use Carbon\Carbon;

class FormacionAcademicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->candidato) {
            try {
                $modelos = FormacionAcademica::where('candidate_id', $request->candidato)->get();
                return FormacionAcademicaResourceFull::collection($modelos);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }

        } else {
            try {
                $modelos = FormacionAcademica::all();
                return FormacionAcademicaResourceFull::collection($modelos);
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
    public function store(Request $request)
    {
        $request->validate([
            'carrera' => 'required',
            'institucion' => 'required',
            'isBecado' => 'required',
            'indice' => 'required',
            'fecha_entrada' => 'required',
        ]);

        // Initialize Google Storage
        $disk = \Storage::disk('google');

        $candidato = auth()->user()->candidate;


        if($candidato) {
            //Image Handling
            if (isset($request->certificado)) {
                $fileName = strtoupper('PNB-'.Carbon::now()->format('Y-m-d')."-".time().".".$request->file('certificado')->getClientOriginalExtension());
                $disk->write($fileName, file_get_contents($request->file('certificado')), ['visibility' => 'public']);
                $image = array(
                    "url" => $disk->url($fileName),
                    "ext" => $request->file('certificado')->getClientOriginalExtension(),
                    "size" => $request->file('certificado')->getSize(),
                );
            } else {
                $image = array(
                    "url" => null,
                    "ext" => null,
                    "size" => null,
                );
            }

            try {
                $formacion = new FormacionAcademica();
                $formacion->candidate_id = $candidato->id;
                $formacion->carrera = $request->carrera;
                $formacion->institucion = $request->institucion;
                $formacion->isBecado = $request->isBecado;
                $formacion->indice = $request->indice;
                $formacion->fecha_entrada = Carbon::parse($request->fecha_entrada);
                $formacion->fecha_salida = isset($request->fecha_salida) ? Carbon::parse($request->fecha_salida) : null;
                $formacion->certificacion_url = $image['url'];
                $formacion->certificacion_ext = $image['ext'];
                $formacion->certificacion_size = $image['size'];
                $formacion->save();

            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
            return new FormacionAcademicaResourceFull($formacion);
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
    public function multiple(Request $request)
    {
        $counter = 0;
        $models_array = null;
        $formaciones =  json_decode($request->getContent());

        // Initialize Google Storage
        $disk = \Storage::disk('google');

        $candidato = auth()->user()->candidate;

        if($candidato) {
            if($formaciones) {
                foreach ($formaciones as $item) {

                        //Image Handling
                    if (isset($item->certificado)) {
                        $fileName = strtoupper('PNB-'.Carbon::now()->format('Y-m-d')."-".time().".".$item->file('certificado')->getClientOriginalExtension());
                        $disk->write($fileName, file_get_contents($item->file('certificado')), ['visibility' => 'public']);
                        $image = array(
                            "url" => $disk->url($fileName),
                            "ext" => $item->file('certificado')->getClientOriginalExtension(),
                            "size" => $item->file('certificado')->getSize(),
                        );
                    } else {
                        $image = array(
                            "url" => null,
                            "ext" => null,
                            "size" => null,
                        );
                    }

                    if(isset($item->id)) {
                        $formacion = FormacionAcademica::findOrFail($item->id);
                        $this->belongsToUser($formacion);
                    } else {
                        $formacion = new FormacionAcademica();
                        $formacion->candidate_id = $candidato->id;

                    }

                    try {
                        $formacion->carrera = $item->carrera;
                        $formacion->institucion = $item->institucion;
                        $formacion->isBecado = $item->isBecado;
                        $formacion->indice = $item->indice;
                        $formacion->fecha_entrada = Carbon::parse($item->fecha_entrada);
                        $formacion->fecha_salida = isset($item->fecha_salida) ? Carbon::parse($item->fecha_salida) : null;
                        if(isset($item->certificado)) {
                            $formacion->certificacion_url = $image['url'];
                            $formacion->certificacion_ext = $image['ext'];
                            $formacion->certificacion_size = $image['size'];
                        }
                        $formacion->save();
                        $models_array[$counter] = $formacion;
                        $counter ++;
                    } catch (\Throwable $th) {
                        throw new SomethingWentWrong($th);
                    }
                }
                return FormacionAcademicaResourceFull::collection($models_array);
                // return $models_array;
            } else {
                throw new ArrayEmpty;
            }
        } else {
            throw new NotCandidate();
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
            'formacion' => 'required',
        ]);

        $formacion = FormacionAcademica::findOrFail($request->formacion);

        try {
            return new FormacionAcademicaResourceFull($formacion);
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
            'formacion' => 'required',
            'carrera' => 'required',
            'institucion' => 'required',
            'isBecado' => 'required',
            'indice' => 'required',
            'fecha_entrada' => 'required',
        ]);

        // Initialize Google Storage
        $disk = \Storage::disk('google');

        $candidato = auth()->user()->candidate;

        $formacion = FormacionAcademica::findOrFail($request->formacion);

        $this->belongsToUser($formacion);


        if($candidato) {
            //Image Handling
            if (isset($request->certificado)) {
                $fileName = strtoupper('PNB-'.Carbon::now()->format('Y-m-d')."-".time().".".$request->file('certificado')->getClientOriginalExtension());
                $disk->write($fileName, file_get_contents($request->file('certificado')), ['visibility' => 'public']);
                $image = array(
                    "url" => $disk->url($fileName),
                    "ext" => $request->file('certificado')->getClientOriginalExtension(),
                    "size" => $request->file('certificado')->getSize(),
                );
            } else {
                $image = array(
                    "url" => null,
                    "ext" => null,
                    "size" => null,
                );
            }

            try {
                $formacion->carrera = $request->carrera;
                $formacion->institucion = $request->institucion;
                $formacion->isBecado = $request->isBecado;
                $formacion->indice = $request->indice;
                $formacion->fecha_entrada = Carbon::parse($request->fecha_entrada);
                $formacion->fecha_salida = isset($request->fecha_salida) ? Carbon::parse($request->fecha_salida) : null;
                if(isset($request->certificado)) {
                    $formacion->certificacion_url = $image['url'];
                    $formacion->certificacion_ext = $image['ext'];
                    $formacion->certificacion_size = $image['size'];
                }
                $formacion->save();

            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
            return new FormacionAcademicaResourceFull($formacion);
        } else {
            throw new NotCandidate();
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
            'formacion' => 'required',
        ]);
        $formacion = FormacionAcademica::findOrFail($request->formacion);

        $this->belongsToUser($formacion);

        try {
            $formacion->delete();
            return Tools::deleted();
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    public static function belongsToUser(FormacionAcademica $formacion)
    {
        if ( auth()->user()->candidate->id == $formacion->candidato->id) {
            return true;
        } else {
            throw new NotBelongsTo;
        }
    }
}