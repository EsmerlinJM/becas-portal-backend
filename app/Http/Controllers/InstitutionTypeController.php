<?php

namespace App\Http\Controllers;

use App\Models\InstitutionType;
use App\Models\Institution;
use Illuminate\Http\Request;

use App\Http\Resources\InstitutionTypeResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class InstitutionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = InstitutionType::all();
        try {
            return InstitutionTypeResource::collection($types);
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
            'name' => 'required',
        ]);

        try {
            $type = new InstitutionType;
            $type->name = $request->name;
            $type->save();
            return new InstitutionTypeResource($type);
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
            'institution_type_id' => 'required',
        ]);

        $type = InstitutionType::findOrFail($request->institution_type_id);

        try {
            return new InstitutionTypeResource($type);
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
            'institution_type_id' => 'required',
            'name' => 'required',
        ]);

        $type = InstitutionType::findOrFail($request->institution_type_id);

        try {
            $type->name = $request->name;
            $type->save();
            return new InstitutionTypeResource($type);
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
            'institution_type_id' => 'required',
        ]);

        $type = InstitutionType::findOrFail($request->institution_type_id);

        if(Institution::where('institution_type_id', $type->id)->count() > 0) {
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