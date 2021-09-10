<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\InstitutionOffer;
use App\Models\AcademicOffer;
use App\Models\AcademicOfferType;
use App\Models\EducationLevel;
use Illuminate\Http\Request;

use App\Http\Resources\AcademicOfferResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;
use Carbon\Carbon;

class AcademicOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'institution_id' => 'required'
        ]);

        $aoffers = AcademicOffer::where('institution_id', $request->institution_id)->get();
        try {
            return AcademicOfferResource::collection($aoffers);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function byEducationLevel(Request $request)
    {
        $request->validate([
            'institution_id' => 'required',
            'education_level_id' => 'required',
        ]);

        $aoffers = AcademicOffer::where('education_level_id',$request->education_level_id)->where('institution_id', $request->institution_id)->get();

        try {
            return AcademicOfferResource::collection($aoffers);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function byOfferType(Request $request)
    {
        $request->validate([
            'institution_id' => 'required',
            'academic_offer_type_id' => 'required',
        ]);

        $aoffers = AcademicOffer::where('academic_offer_type_id',$request->academic_offer_type_id)->where('institution_id', $request->institution_id)->get();

        try {
            return AcademicOfferResource::collection($aoffers);
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
            'institution_id' => 'required',
            'academic_offer_type_id' => 'required',
            'education_level_id' => 'required',
            'career' => 'required',
            'duration' => 'required',
            'language' => 'required',
        ]);

        // Initialize Google Storage
        $disk = \Storage::disk('google');



        Institution::findOrFail($request->institution_id); //Valido si existe
        AcademicOfferType::findOrFail($request->academic_offer_type_id); //Valido si existe
        EducationLevel::findOrFail($request->education_level_id); //Valido si existe

        try {

                //PDF or Image Handling
            if (isset($request->pensum)) {
                $fileName = strtoupper('PNB-'.Carbon::now()->format('Y-m-d')."-".time().".".$request->file('pensum')->getClientOriginalExtension());
                $disk->write($fileName, file_get_contents($request->file('pensum')), ['visibility' => 'public']);
                $pensum = array(
                    "url" => $disk->url($fileName),
                    "ext" => $request->file('pensum')->getClientOriginalExtension(),
                    "size" => $request->file('pensum')->getSize(),
                );
            } else {
                $pensum = array(
                    "url" => null,
                    "ext" => null,
                    "size" => null,
                );
            }

            $aoffer = new AcademicOffer;
            $aoffer->active = 1; //Activo por Defecto
            $aoffer->institution_id = $request->institution_id;
            $aoffer->academic_offer_type_id = $request->academic_offer_type_id;
            $aoffer->education_level_id = $request->education_level_id;
            $aoffer->career = $request->career;
            $aoffer->duration = $request->duration;
            $aoffer->language = $request->language;
            $aoffer->creditos = $request->creditos;
            $aoffer->esfuerzo = $request->esfuerzo;
            $aoffer->costo = $request->costo;
            $aoffer->pensum_url = $pensum['url'];
            $aoffer->pensum_ext = $pensum['ext'];
            $aoffer->pensum_size = $pensum['size'];
            $aoffer->save();

            return new AcademicOfferResource($aoffer);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->validate([
            'academic_offer_id' => 'required',
        ]);

        $aoffer = AcademicOffer::findOrFail($request->academic_offer_id);

        try {
            return new AcademicOfferResource($aoffer);
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
            'academic_offer_id' => 'required',
            'academic_offer_type_id' => 'required',
            'education_level_id' => 'required',
            'career' => 'required',
            'duration' => 'required',
            'language' => 'required',
        ]);

        // Initialize Google Storage
        $disk = \Storage::disk('google');

        $aoffer = AcademicOffer::findOrFail($request->academic_offer_id);

        AcademicOfferType::findOrFail($request->academic_offer_type_id); //Valido si existe
        EducationLevel::findOrFail($request->education_level_id); //Valido si existe

        try {

            //PDF or Image Handling
            if (isset($request->pensum)) {
                $fileName = strtoupper('PNB-'.Carbon::now()->format('Y-m-d')."-".time().".".$request->file('pensum')->getClientOriginalExtension());
                $disk->write($fileName, file_get_contents($request->file('pensum')), ['visibility' => 'public']);
                $pensum = array(
                    "url" => $disk->url($fileName),
                    "ext" => $request->file('pensum')->getClientOriginalExtension(),
                    "size" => $request->file('pensum')->getSize(),
                );
            } else {
                $pensum = array(
                    "url" => null,
                    "ext" => null,
                    "size" => null,
                );
            }

            $aoffer->academic_offer_type_id = $request->academic_offer_type_id;
            $aoffer->education_level_id = $request->education_level_id;
            $aoffer->career = $request->career;
            $aoffer->duration = $request->duration;
            $aoffer->language = $request->language;
            $aoffer->creditos = $request->creditos;
            $aoffer->esfuerzo = $request->esfuerzo;
            $aoffer->costo = $request->costo;
            if (isset($request->pensum)) {
                $aoffer->pensum_url = $pensum['url'];
                $aoffer->pensum_ext = $pensum['ext'];
                $aoffer->pensum_size = $pensum['size'];
            }
            $aoffer->save();

            return new AcademicOfferResource($aoffer);
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
            'academic_offer_id' => 'required',
        ]);

        $aoffer = AcademicOffer::findOrFail($request->academic_offer_id);

            if($aoffer->active) {
                throw new AlreadyActive;
            } else {
                try {
                 $aoffer->active = 1; //Activamos
                 $aoffer->save();
                 return new AcademicOfferResource($aoffer);
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
            'academic_offer_id' => 'required',
        ]);

        $aoffer = AcademicOffer::findOrFail($request->academic_offer_id);

            if(!$aoffer->active) {
                throw new AlreadyDeactivated;
            } else {
                try {
                    $aoffer->active = 0; //Desactivamos
                    $aoffer->save();
                    return new AcademicOfferResource($aoffer);
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
            'academic_offer_id' => 'required',
        ]);

        $aoffer = AcademicOffer::findOrFail($request->academic_offer_id);

        if(InstitutionOffer::where('academic_offer_id', $aoffer->id)->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $aoffer->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}