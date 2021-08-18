<?php

namespace App\Http\Controllers;

use App\Models\InstitutionOffer;
use App\Models\Institution;
use App\Models\AcademicOffer;
use App\Models\Campus;
use Illuminate\Http\Request;

use App\Http\Resources\InstitutionOfferResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class InstitutionOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = InstitutionOffer::all();
        try {
            return InstitutionOfferResource::collection($offers);
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
    public function byInstitution(Request $request)
    {
        $request->validate([
            'institution_id' => 'required',
        ]);

        $offers = InstitutionOffer::where('institution_id', $request->institution_id)->get();
        try {
            return InstitutionOfferResource::collection($offers);
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
            'academic_offer_id' => 'required',
            'campus_id' => 'required',
        ]);

        Institution::findOrFail($request->institution_id); //Valido si la institucion existe
        AcademicOffer::findOrFail($request->academic_offer_id); //Valido si la oferta academica existe
        Campus::findOrFail($request->campus_id); //Valido si el campus existe

        try {
            $offer = new InstitutionOffer;
            $offer->institution_id = $request->institution_id;
            $offer->academic_offer_id = $request->academic_offer_id;
            $offer->campus_id = $request->campus_id;
            $offer->save();
            return new InstitutionOfferResource($offer);
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
            'institution_offer_id' => 'required',
        ]);

        $offer = InstitutionOffer::findOrFail($request->institution_offer_id);

        try {
            return new InstitutionOfferResource($offer);
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
            'institution_offer_id' => 'required',
            'institution_id' => 'required',
            'academic_offer_id' => 'required',
            'campus_id' => 'required',
        ]);

        $offer = InstitutionOffer::findOrFail($request->institution_offer_id); //Valido si la institucion existe
        Institution::findOrFail($request->institution_id); //Valido si la institucion existe
        AcademicOffer::findOrFail($request->academic_offer_id); //Valido si la oferta academica existe
        Campus::findOrFail($request->campus_id); //Valido si el campus existe

        try {
            $offer->institution_id = $request->institution_id;
            $offer->academic_offer_id = $request->academic_offer_id;
            $offer->campus_id = $request->campus_id;
            $offer->save();
            return new InstitutionOfferResource($offer);
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
            'institution_offer_id' => 'required',
        ]);

        $offer = InstitutionOffer::findOrFail($request->institution_offer_id);

        try {
            $offer->delete();
            return Tools::deleted();
        } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }

    }
}