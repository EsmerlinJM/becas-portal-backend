<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use Illuminate\Http\Request;

use App\Tools\ResponseCodes;
use App\Http\Resources\MunicipalityResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class MunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $municipalities = Municipality::orderBy('name','asc')->get();
            return MunicipalityResource::collection($municipalities);
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
            'identifier' => 'required',
        ]);

        try {
            $municipality = Municipality::where('identifier',$request->identifier)->get()->first();

            if($municipality){
                return new MunicipalityResource($municipality);
            } else {
                return response()->json(['status' => 'ok', 'message' => 'Sin resultados'], ResponseCodes::NOT_FOUND);
            }
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

     /**
     * search in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            'busqueda' => 'required',
        ]);

        try {
            $municipalities = Municipality::where('name','like','%'.$request->busqueda.'%')->get();
            if($municipalities->count() <= 0 ){
                return response()->json(['status' => 'ok', 'message' => 'Sin resultados'], ResponseCodes::NOT_FOUND);
            } else {
                return MunicipalityResource::collection($municipalities);
            }
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }


    /**
    * search in storage by province
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function byProvince(Request $request)
    {
        $request->validate([
            'province_code' => 'required',
        ]);

        try {
            $municipalities = Municipality::where('province_code', $request->province_code)->get();
            if($municipalities->count() <= 0 ){
                return response()->json(['status' => 'ok', 'message' => 'Sin resultados'], ResponseCodes::NOT_FOUND);
            } else {
                return MunicipalityResource::collection($municipalities);
            }
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }



}