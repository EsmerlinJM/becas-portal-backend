<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

use App\Tools\ResponseCodes;
use App\Http\Resources\CountryResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $countries = Country::orderBy('name','asc')->get();
            return CountryResource::collection($countries);
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
            'country_id' => 'required',
        ]);

        $country = Country::findOrFail($request->country_id);

        try {
            return new CountryResource($country);
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
            $countries = Country::where('name','like','%'.$request->busqueda.'%')->get();
            if($countries->count() <= 0 ){
                return response()->json(['status' => 'ok', 'message' => 'Sin resultados'], ResponseCodes::NOT_FOUND);
            } else {
                return CountryResource::collection($countries);
            }
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }

    }




}