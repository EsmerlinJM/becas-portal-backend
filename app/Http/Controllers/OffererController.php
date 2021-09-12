<?php

namespace App\Http\Controllers;

use App\Models\Offerer;
use App\Models\ConvocatoriaDetail;
use Illuminate\Http\Request;

use App\Http\Resources\OffererResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;
use Carbon\Carbon;

use App\Tools\GoogleBucketTrait;

class OffererController extends Controller
{

    use GoogleBucketTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oferentes = Offerer::all();
        try {
            return OffererResource::collection($oferentes);
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
            'document_id' => 'required',
            'type' => 'required',
            'contact_person' => 'required',
            'contact_number' => 'required',
            'contact_email' => 'required',
        ]);

        try {

            //Image Handling
            $image = $this->upload($request, 'image');

            $oferente = new Offerer;
            $oferente->name = $request->name;
            $oferente->document_id = $request->document_id;
            $oferente->type = $request->type;
            $oferente->contact_person = $request->contact_person;
            $oferente->contact_number = $request->contact_number;
            $oferente->contact_email = $request->contact_email;
            $oferente->image_url = $image['url'];
            $oferente->image_ext = $image['ext'];
            $oferente->image_size = $image['size'];
            $oferente->save();

            return new OffererResource($oferente);
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
            'offerer_id' => 'required',
        ]);

        $oferente = Offerer::findOrFail($request->offerer_id);

        try {
            return new OffererResource($oferente);

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
            'offerer_id' => 'required',
            'name' => 'required',
            'document_id' => 'required',
            'type' => 'required',
            'contact_person' => 'required',
            'contact_number' => 'required',
            'contact_email' => 'required',
        ]);

        $oferente = Offerer::findOrFail($request->offerer_id);

        try {

            //Image Handling
            $image = $this->upload($request, 'image');

            $oferente->name = $request->name;
            $oferente->document_id = $request->document_id;
            $oferente->type = $request->type;
            $oferente->contact_person = $request->contact_person;
            $oferente->contact_number = $request->contact_number;
            $oferente->contact_email = $request->contact_email;
            if (isset($request->image)) {
                $oferente->image_url = $image['url'];
                $oferente->image_ext = $image['ext'];
                $oferente->image_size = $image['size'];
            }
            $oferente->save();

            return new OffererResource($oferente);
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
            'offerer_id' => 'required',
        ]);

        $oferente = Offerer::findOrFail($request->offerer_id);

        if(ConvocatoriaDetail::where('offerer_id',$oferente->id)->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $oferente->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}