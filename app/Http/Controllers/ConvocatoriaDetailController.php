<?php

namespace App\Http\Controllers;

use App\Models\Offerer;
use App\Models\Schedule;
use App\Models\Convocatoria;
use App\Models\ConvocatoriaDetail;
use Illuminate\Http\Request;

use App\Http\Resources\ConvocatoriaDetailResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;
use Carbon\Carbon;

class ConvocatoriaDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $request->validate([
            'convocatoria_id' => 'required',
        ]);

        Convocatoria::findOrFail($request->convocatoria_id); //Valido si no se ha borrado la convocatoria a la que pertenecen.
        $detalles = ConvocatoriaDetail::where('convocatoria_id',$request->convocatoria_id)->get();

        try {
            return ConvocatoriaDetailResource::collection($detalles);
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
            'convocatoria_id' => 'required',
            'institution_id' => 'required',
            'campus_id' => 'required',
            'academic_offer_id' => 'required',
            'offerer_id' => 'required',
            'evaluation_id' => 'required',
            'schedule_id' => 'required',
            'coverage' => 'required',
        ]);

        // Initialize Google Storage
        $disk = \Storage::disk('google');

        Convocatoria::findOrFail($request->convocatoria_id); //Valido si la convocatoria existe
        Offerer::findOrFail($request->offerer_id); //Valido si el oferente existe
        Schedule::findOrFail($request->schedule_id); //Valido si el horario existe

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

            $detalle = new ConvocatoriaDetail;
            $detalle->convocatoria_id = $request->convocatoria_id;
            $detalle->institution_id = $request->institution_id;
            $detalle->campus_id = $request->campus_id;
            $detalle->academic_offer_id = $request->academic_offer_id;
            $detalle->offerer_id = $request->offerer_id;
            $detalle->evaluation_id = $request->evaluation_id;
            $detalle->schedule_id = $request->schedule_id;
            $detalle->coverage = $request->coverage;
            $detalle->image_url = $image['url'];
            $detalle->image_ext = $image['ext'];
            $detalle->image_size = $image['size'];
            $detalle->save();
            return new ConvocatoriaDetailResource($detalle);

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
            'convocatoria_detail_id' => 'required',
        ]);

        $detalle = ConvocatoriaDetail::findOrFail($request->convocatoria_detail_id);

        try {
            return new ConvocatoriaDetailResource($detalle);

        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ConvocatoriaDetail  $convocatoriaDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConvocatoriaDetail $convocatoriaDetail)
    {
        $request->validate([
            'convocatoria_detail_id' => 'required',
            'institution_id' => 'required',
            'campus_id' => 'required',
            'academic_offer_id' => 'required',
            'offerer_id' => 'required',
            'evaluation_id' => 'required',
            'schedule_id' => 'required',
            'coverage' => 'required',
        ]);

        // Initialize Google Storage
        $disk = \Storage::disk('google');

        $detalle = ConvocatoriaDetail::findOrFail($request->convocatoria_detail_id); //Valido si el Detalle Existe
        Offerer::findOrFail($request->offerer_id); //Valido si el oferente existe
        Schedule::findOrFail($request->schedule_id); //Valido si el horario existe

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
                    "url" => $detalle->image_url,
                    "ext" => $detalle->image_ext,
                    "size" => $detalle->image_size,
                );
            }

            $detalle->institution_id = $request->institution_id;
            $detalle->campus_id = $request->campus_id;
            $detalle->academic_offer_id = $request->academic_offer_id;
            $detalle->offerer_id = $request->offerer_id;
            $detalle->evaluation_id = $request->evaluation_id;
            $detalle->schedule_id = $request->schedule_id;
            $detalle->coverage = $request->coverage;
            $detalle->image_url = $image['url'];
            $detalle->image_ext = $image['ext'];
            $detalle->image_size = $image['size'];
            $detalle->save();

            return new ConvocatoriaDetailResource($detalle);

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
            'convocatoria_detail_id' => 'required',
        ]);

        $detalle = ConvocatoriaDetail::findOrFail($request->convocatoria_detail_id); //Valida si existe antes de procesar

        try {
            $detalle->delete();
            return Tools::deleted();
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }
}