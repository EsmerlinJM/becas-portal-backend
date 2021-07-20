<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Municipality;
use App\Models\Province;
use App\Models\Country;
use App\Models\Institution;
use App\Models\InstitutionOffer;
use Illuminate\Http\Request;

use App\Http\Resources\CampusResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campuses = Campus::all();
        try {
            return CampusResource::collection($campuses);
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

        $campuses = Campus::where('institution_id', $request->institution_id)->get();
        try {
            return CampusResource::collection($campuses);
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
            'municipality_id' => 'required',
            'province_id' => 'required',
            'country_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
        ]);

            Institution::findOrFail($request->institution_id); //Valido si la institucion existe
            Municipality::findOrFail($request->municipality_id);
            Province::findOrFail($request->province_id);
            Country::findOrFail($request->country_id);

        try {
            $campus = new Campus;
            $campus->institution_id = $request->institution_id;
            $campus->municipality_id = $request->municipality_id;
            $campus->province_id = $request->province_id;
            $campus->country_id = $request->country_id;
            $campus->name = $request->name;
            $campus->address = $request->address;
            $campus->phone_number = $request->phone_number;
            $campus->save();
            return new CampusResource($campus);
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
            'campus_id' => 'required',
        ]);

        $campus = Campus::findOrFail($request->campus_id);

        try {
            return new CampusResource($campus);
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
            'campus_id' => 'required',
            'institution_id' => 'required',
            'municipality_id' => 'required',
            'province_id' => 'required',
            'country_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
        ]);

        $campus = Campus::findOrFail($request->campus_id); //Valido si el campus existe
        Institution::findOrFail($request->institution_id); //Valido si la institucion existe
        Municipality::findOrFail($request->municipality_id);
        Province::findOrFail($request->province_id);
        Country::findOrFail($request->country_id);

        try {
            $campus->institution_id = $request->institution_id;
            $campus->municipality_id = $request->municipality_id;
            $campus->province_id = $request->province_id;
            $campus->country_id = $request->country_id;
            $campus->name = $request->name;
            $campus->address = $request->address;
            $campus->phone_number = $request->phone_number;
            $campus->save();
            return new CampusResource($campus);
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
            'campus_id' => 'required',
        ]);

        $campus = Campus::findOrFail($request->campus_id);

        if(InstitutionOffer::where('campus_id', $campus->id)->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $campus->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}