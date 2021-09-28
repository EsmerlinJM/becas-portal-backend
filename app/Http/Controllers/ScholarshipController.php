<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;

use App\Http\Resources\ScholarshipResource;
use App\Http\Resources\BecasResourceCandidato;
use App\Http\Resources\EstadosBecaResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\NotCandidate;
use App\Tools\Tools;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class ScholarshipController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function estados()
    {
        $estados = ['egresado','retirado','expulsado','activo','suspendido'];

        try {
            return new EstadosBecaResource($estados);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $becas = Scholarship::paginate(30);
        try {
            return ScholarshipResource::collection($becas);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function becado()
    {
        $usuario = auth()->user();
        if($usuario->candidate){
            $becas = Scholarship::where('candidate_id', $usuario->candidate->id)->get();
            try {
                return BecasResourceCandidato::collection($becas);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            throw new NotCandidate();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function egresados()
    {
        $becas = Scholarship::where('estado','egresado')->paginate(30);
        try {
            return ScholarshipResource::collection($becas);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function retirados()
    {
        $becas = Scholarship::where('estado','retirado')->paginate(30);
        try {
            return ScholarshipResource::collection($becas);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function expulsados()
    {
        $becas = Scholarship::where('estado','expulsado')->paginate(30);
        try {
            return ScholarshipResource::collection($becas);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activos()
    {
        $becas = Scholarship::where('estado','activo')->paginate(30);
        try {
            return ScholarshipResource::collection($becas);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function suspendidos()
    {
        $becas = Scholarship::where('estado','suspendido')->paginate(30);
        try {
            return ScholarshipResource::collection($becas);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $becas = Scholarship::paginate(30); //Empty Collection

        if($request->institution_id) {
            $becas = Scholarship::where('institution_id', $request->institution_id)->paginate(30);
        }

        if($request->convocatoria_id) {
            $becas = Scholarship::where('convocatoria_id', $request->convocatoria_id)->paginate(30);
        }

        if($request->offerer_id) {
            $becas = Scholarship::where('offerer_id', $request->offerer_id)->paginate(30);
        }

        if($request->candidate_id) {
            $becas = Scholarship::where('candidate_id', $request->candidate_id)->paginate(30);
        }

        try {
            return ScholarshipResource::collection($becas);
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
            'scholarship_id' => 'required',
        ]);

        $beca = Scholarship::findOrFail($request->scholarship_id);

        try {
            return new ScholarshipResource($beca);
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
    public function updateEstado(Request $request)
    {
        $request->validate([
            'scholarship_id' => 'required',
            'estado'    => ['required', Rule::in(['egresado','retirado','expulsado','activo','suspendido']),]
        ]);

        $beca = Scholarship::findOrFail($request->scholarship_id);

        try {
            $beca->estado = $request->estado;
            $beca->updated_at = Carbon::now();
            $beca->save();
            return new ScholarshipResource($beca);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }


}