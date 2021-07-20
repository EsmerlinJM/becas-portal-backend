<?php

namespace App\Http\Controllers;

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

class AcademicOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aoffers = AcademicOffer::all();
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
            'education_level_id' => 'required',
        ]);

        $aoffers = AcademicOffer::where('education_level_id',$request->education_level_id)->get();

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
            'academic_offer_type_id' => 'required',
        ]);

        $aoffers = AcademicOffer::where('academic_offer_type_id',$request->academic_offer_type_id)->get();

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
            'academic_offer_type_id' => 'required',
            'education_level_id' => 'required',
            'career' => 'required',
            'duration' => 'required',
            'language' => 'required',
            'pensum' => 'required',
        ]);

        AcademicOfferType::findOrFail($request->academic_offer_type_id); //Valido si existe
        EducationLevel::findOrFail($request->education_level_id); //Valido si existe

        try {
            $aoffer = new AcademicOffer;
            $aoffer->active = 1; //Activo por Defecto
            $aoffer->academic_offer_type_id = $request->academic_offer_type_id;
            $aoffer->education_level_id = $request->education_level_id;
            $aoffer->career = $request->career;
            $aoffer->duration = $request->duration;
            $aoffer->language = $request->language;
            $aoffer->pensum = $request->pensum;
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
            'pensum' => 'required',
        ]);

        $aoffer = AcademicOffer::findOrFail($request->academic_offer_id);

        AcademicOfferType::findOrFail($request->academic_offer_type_id); //Valido si existe
        EducationLevel::findOrFail($request->education_level_id); //Valido si existe

        try {
            $aoffer->academic_offer_type_id = $request->academic_offer_type_id;
            $aoffer->education_level_id = $request->education_level_id;
            $aoffer->career = $request->career;
            $aoffer->duration = $request->duration;
            $aoffer->language = $request->language;
            $aoffer->pensum = $request->pensum;
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