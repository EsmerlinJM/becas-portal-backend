<?php

namespace App\Http\Controllers;

use App\Models\Offerer;
use App\Models\Formulario;
use App\Models\InstitutionOffer;
use App\Models\Convocatoria;
use App\Models\ConvocatoriaDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\ConvocatoriaDetailResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;
use Carbon\Carbon;

use App\Tools\GoogleBucketTrait;

class ConvocatoriaDetailController extends Controller
{

    use GoogleBucketTrait;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        $request->validate([
            'busqueda' => 'required',
        ]);

        $detalles = null;
        $counter = 0;
        $all = ConvocatoriaDetail::orderBy('created_at', 'desc')->get();

        foreach ($all as $item) {
            if(str_contains($item->oferta->academic_offer->career, $request->busqueda) ){
                $detalles[$counter] = $item;
                $counter++;
            }
        }

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
            'institution_offer_id' => 'required',
            'formulario_id' => 'required',
            'offerer_id' => 'required',
            'coverage' => 'required',
        ]);

        $convocatoria = Convocatoria::findOrFail($request->convocatoria_id); //Valido si la convocatoria existe
        $oferente = Offerer::findOrFail($request->offerer_id); //Valido si el oferente existe
        $oferta = InstitutionOffer::findOrFail($request->institution_offer_id); //Valido si la oferta existe
        $formulario = Formulario::findOrFail($request->formulario_id); //Valido si fomulario existe

        try {

            //Image Handling
            $image = $this->upload($request, "image");

            $detalle = new ConvocatoriaDetail;
            $detalle->convocatoria_id = $convocatoria->id;
            $detalle->institution_offer_id = $oferta->id;
            $detalle->institution_id = $oferta->institution->id;
            $detalle->offerer_id = $oferente->id;
            $detalle->coverage = $request->coverage;
            $detalle->evaluation_id = $convocatoria->evaluation->id;
            $detalle->formulario_id = $formulario->id;
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
            'institution_offer_id' => 'required',
            'offerer_id' => 'required',
            'formulario_id' => 'required',
            'coverage' => 'required',
        ]);

        $detalle = ConvocatoriaDetail::findOrFail($request->convocatoria_detail_id); //Valido si el Detalle Existe
        $oferente = Offerer::findOrFail($request->offerer_id); //Valido si el oferente existe
        $oferta = InstitutionOffer::findOrFail($request->institution_offer_id); //Valido si la oferta existe
        $formulario = Formulario::findOrFail($request->formulario_id); //Valido si fomulario existe

        try {
            //Image Handling
            $image = $this->upload($request, "image");

            $detalle->institution_offer_id = $oferta->id;
            $detalle->institution_id = $oferta->institution->id;
            $detalle->formulario_id = $formulario->id;
            $detalle->offerer_id = $oferente->id;
            $detalle->coverage = $request->coverage;
            if (isset($request->image)) {
                $detalle->image_url = $image['url'];
                $detalle->image_ext = $image['ext'];
                $detalle->image_size = $image['size'];
            }
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