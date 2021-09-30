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
use App\Exceptions\NotBelongsTo;
use App\Exceptions\NotPermissions;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;
use App\Tools\GoogleBucketTrait;
use Carbon\Carbon;

class AcademicOfferController extends Controller
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
            'institution_id' => 'required'
        ]);

        $carreras = AcademicOffer::where('institution_id', $request->institution_id)->get();



        try {
            return AcademicOfferResource::collection($carreras);
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

        $carreras = AcademicOffer::where('education_level_id',$request->education_level_id)->where('institution_id', $request->institution_id)->get();

        try {
            return AcademicOfferResource::collection($carreras);
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

        $carreras = AcademicOffer::where('academic_offer_type_id',$request->academic_offer_type_id)->where('institution_id', $request->institution_id)->get();

        try {
            return AcademicOfferResource::collection($carreras);
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
            'academic_offer_type_id' => 'required',
            'education_level_id' => 'required',
            'career' => 'required',
            'duration' => 'required',
            'language' => 'required',
        ]);


        $usuario = auth()->user();

        if($usuario->institution) {
            AcademicOfferType::findOrFail($request->academic_offer_type_id); //Valido si existe
            EducationLevel::findOrFail($request->education_level_id); //Valido si existe

            try {

                //PDF or Image Handling
                $pensum = $this->upload($request, "pensum");

                $carrera = new AcademicOffer;
                $carrera->active = 1; //Activo por Defecto
                $carrera->institution_id = $usuario->institution->id;
                $carrera->academic_offer_type_id = $request->academic_offer_type_id;
                $carrera->education_level_id = $request->education_level_id;
                $carrera->career = $request->career;
                $carrera->duration = $request->duration;
                $carrera->language = $request->language;
                $carrera->creditos = $request->creditos;
                $carrera->esfuerzo = $request->esfuerzo;
                $carrera->costo = $request->costo;
                $carrera->pensum_url = $pensum['url'];
                $carrera->pensum_ext = $pensum['ext'];
                $carrera->pensum_size = $pensum['size'];
                $carrera->save();

                return new AcademicOfferResource($carrera);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }

        } else {
            throw new NotPermissions();
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

        $carrera = AcademicOffer::findOrFail($request->academic_offer_id);

        try {
            return new AcademicOfferResource($carrera);
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

        $carrera = AcademicOffer::findOrFail($request->academic_offer_id);

        $this->belongsToUser($carrera);

        AcademicOfferType::findOrFail($request->academic_offer_type_id); //Valido si existe
        EducationLevel::findOrFail($request->education_level_id); //Valido si existe

        try {

            //PDF or Image Handling
            $pensum = $this->upload($request, "pensum");


            $carrera->academic_offer_type_id = $request->academic_offer_type_id;
            $carrera->education_level_id = $request->education_level_id;
            $carrera->career = $request->career;
            $carrera->duration = $request->duration;
            $carrera->language = $request->language;
            $carrera->creditos = $request->creditos;
            $carrera->esfuerzo = $request->esfuerzo;
            $carrera->costo = $request->costo;
            if (isset($request->pensum)) {
                $carrera->pensum_url = $pensum['url'];
                $carrera->pensum_ext = $pensum['ext'];
                $carrera->pensum_size = $pensum['size'];
            }
            $carrera->save();

            return new AcademicOfferResource($carrera);
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

        $carrera = AcademicOffer::findOrFail($request->academic_offer_id);

        $this->belongsToUser($carrera);

            if($carrera->active) {
                throw new AlreadyActive;
            } else {
                try {
                 $carrera->active = 1; //Activamos
                 $carrera->save();
                 return new AcademicOfferResource($carrera);
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

        $this->belongsToUser($carrera);

        $carrera = AcademicOffer::findOrFail($request->academic_offer_id);

            if(!$carrera->active) {
                throw new AlreadyDeactivated;
            } else {
                try {
                    $carrera->active = 0; //Desactivamos
                    $carrera->save();
                    return new AcademicOfferResource($carrera);
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

        $carrera = AcademicOffer::findOrFail($request->academic_offer_id);

        $this->belongsToUser($carrera);

        if(InstitutionOffer::where('academic_offer_id', $carrera->id)->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $carrera->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }

    public static function belongsToUser(AcademicOffer $oferta)
    {
        if(auth()->user()->institution) {
            if ( auth()->user()->institution->id == $oferta->institution_id) {
                return true;
            } else {
                throw new NotBelongsTo;
            }
        } else {
            throw new NotBelongsTo;
        }

    }
}
