<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\InstitutionOffer;
use App\Models\Institution;
use App\Models\InstitutionType;
use Illuminate\Http\Request;

use App\Http\Resources\InstitutionResource;
use App\Http\Resources\InstitutionFullResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;
use Carbon\Carbon;

use App\Tools\GoogleBucketTrait;

class InstitutionController extends Controller
{

    use GoogleBucketTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituciones = Institution::all();
        try {
            return InstitutionResource::collection($instituciones);
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
            'institution_type_id' => 'required',
            'name' => 'required',
        ]);

        InstitutionType::findOrFail($request->institution_type_id); //Valido si el tipo de institucion existe

        try {

            //Image Handling
            $image = $this->upload($request, 'image');

            $institucion = new Institution;
            $institucion->institution_type_id = $request->institution_type_id;
            $institucion->name = $request->name;
            $institucion->siglas = $request->siglas;
            $institucion->telefono = $request->telefono;
            $institucion->email = $request->email;
            $institucion->direccion = $request->direccion;
            $institucion->web = $request->web;
            $institucion->contacto_persona = $request->contacto_persona;
            $institucion->contacto_email = $request->contacto_email;
            $institucion->contacto_telefono = $request->contacto_telefono;
            $institucion->image_url = $image['url'];
            $institucion->image_ext = $image['ext'];
            $institucion->image_size = $image['size'];
            $institucion->save();

            return new InstitutionResource($institucion);
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
    public function show(Request  $request)
    {
        $request->validate([
            'institution_id' => 'required',
        ]);

        $institucion = Institution::findOrFail($request->institution_id);

        try {
            return new InstitutionFullResource($institucion);
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
            'institution_id' => 'required',
            'institution_type_id' => 'required',
            'name' => 'required',
        ]);

        $institucion = Institution::findOrFail($request->institution_id); //Valido si la institucion existe
        InstitutionType::findOrFail($request->institution_type_id); //Valido si el tipo de institucion existe

        // return $request->institution_type_id;
        try {

            //Image Handling
            $image = $this->upload($request, 'image');


            $institucion->institution_type_id = $request->institution_type_id;
            $institucion->name = $request->name;
            $institucion->siglas = $request->siglas;
            $institucion->telefono = $request->telefono;
            $institucion->email = $request->email;
            $institucion->direccion = $request->direccion;
            $institucion->web = $request->web;
            $institucion->contacto_persona = $request->contacto_persona;
            $institucion->contacto_email = $request->contacto_email;
            $institucion->contacto_telefono = $request->contacto_telefono;
            if (isset($request->image)) {
                $institucion->image_url = $image['url'];
                $institucion->image_ext = $image['ext'];
                $institucion->image_size = $image['size'];
            }
            $institucion->save();
            return new InstitutionResource($institucion);
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
            'institution_id' => 'required',
        ]);

        $institucion = Institution::findOrFail($request->institution_id);

        if(Campus::where('institution_id', $institucion->id)->count() > 0 || InstitutionOffer::where('institution_id', $institucion->id)->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $institucion->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}
