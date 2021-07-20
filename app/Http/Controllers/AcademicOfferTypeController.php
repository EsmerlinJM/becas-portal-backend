<?php

namespace App\Http\Controllers;

use App\Models\AcademicOfferType;
use App\Models\AcademicOffer;
use Illuminate\Http\Request;

use App\Http\Resources\AcademicOfferTypeResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class AcademicOfferTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = AcademicOfferType::all();
        try {
            return AcademicOfferTypeResource::collection($types);
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
            'description' => 'required',
        ]);

        try {
            $type = new AcademicOfferType;
            $type->description = $request->description;
            $type->save();
            return new AcademicOfferTypeResource($type);
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
            'academic_offer_type_id' => 'required',
        ]);

        $type = AcademicOfferType::findOrFail($request->academic_offer_type_id);

        try {
            return new AcademicOfferTypeResource($type);
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
            'academic_offer_type_id' => 'required',
            'description' => 'required',
        ]);

        $type = AcademicOfferType::findOrFail($request->academic_offer_type_id);

        try {
            $type->description = $request->description;
            $type->save();
            return new AcademicOfferTypeResource($type);
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
            'academic_offer_type_id' => 'required',
        ]);

        $type = AcademicOfferType::findOrFail($request->academic_offer_type_id);

        if(AcademicOffer::where('academic_offer_type_id', $type->id)->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $type->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}