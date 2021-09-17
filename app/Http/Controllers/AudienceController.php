<?php

namespace App\Http\Controllers;

use App\Models\Convocatoria;
use App\Models\Audience;
use Illuminate\Http\Request;

use App\Http\Resources\AudienceResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class AudienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $audiences = Audience::all();
            return AudienceResource::collection($audiences);
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
            $audience = new Audience;
            $audience->name = $request->name;
            $audience->save();
            return new AudienceResource($audience);
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
            'audience_id' => 'required',
        ]);

        $audience = Audience::findOrFail($request->audience_id);

        try {
            return new AudienceResource($audience);
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
            'audience_id' => 'required',
            'name' => 'required',
        ]);

        $bago = 0;

        $audience = Audience::findOrFail($request->audience_id);

        try {
            $audience->name = $request->name;
            $audience->save();

            return new AudienceResource($audience);
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
            'audience_id' => 'required',
        ]);

        $audience = Audience::findOrFail($request->audience_id);

        if(Convocatoria::where('audience_id',$audience->id)->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $audience->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}
