<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\InstitutionOffer;
use App\Models\Institution;
use App\Models\InstitutionType;
use Illuminate\Http\Request;

use App\Http\Resources\InstitutionResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;
use Carbon\Carbon;

class InstitutionController extends Controller
{
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

        // Initialize Google Storage
        $disk = \Storage::disk('google');

        InstitutionType::findOrFail($request->institution_type_id); //Valido si el tipo de institucion existe

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

            $institucion = new Institution;
            $institucion->institution_type_id = $request->institution_type_id;
            $institucion->siglas = $request->siglas;
            $institucion->name = $request->name;
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
            return new InstitutionResource($institucion);
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

        // Initialize Google Storage
        $disk = \Storage::disk('google');


        $institucion = Institution::findOrFail($request->institution_id); //Valido si la institucion existe
        InstitutionType::findOrFail($request->institution_type_id); //Valido si el tipo de institucion existe

        // return $request->institution_type_id;
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
                "url" => $institution->image_url,
                "ext" => $institution->image_ext,
                "size" => $institution->image_size,
            );
        }

            $institucion->institution_type_id = $request->institution_type_id;
            $institucion->siglas = $request->siglas;
            $institucion->name = $request->name;
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