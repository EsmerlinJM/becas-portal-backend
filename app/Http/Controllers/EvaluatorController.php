<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Evaluator;
use App\Models\AplicationDetail;
use App\Models\Coordinator;
use Illuminate\Http\Request;

use Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\EvaluatorResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\EmailNotValid;
use App\Tools\Tools;
use Carbon\Carbon;

use App\Tools\GoogleBucketTrait;

class EvaluatorController extends Controller
{

    use GoogleBucketTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $evaluators = Evaluator::all();
            return EvaluatorResource::collection($evaluators);
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
            'coordinator_id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users',
            'password'  => 'required|confirmed',
            'phone' => 'required',
        ]);

        //Image Handling
        $image = $this->upload($request, "image");

        $coordinator = Coordinator::findOrFail($request->coordinator_id);

        try {
            $user = new User;
            $user->email = $request->email;
            $user->role_id = Tools::EVALUADOR;
            $user->password = Hash::make($request->password);
            $user->save();

            $evaluator = new Evaluator;
            $evaluator->user_id = $user->id;
            $evaluator->coordinator_id = $coordinator->id;
            $evaluator->image_url = $image['url'];
            $evaluator->image_ext = $image['ext'];
            $evaluator->image_size = $image['size'];
            $evaluator->name = $request->name;
            $evaluator->contact_phone = $request->phone;
            $evaluator->contact_email = $request->email;
            $evaluator->save();

        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }

            try {
                event(new Registered($user));
            } catch (\Throwable $th) {
                $evaluator->forceDelete();
                $user->forceDelete();
                throw new EmailNotValid;
            }

        return new EvaluatorResource($evaluator);

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
            'evaluator_id' => 'required',
        ]);

        $evaluator = Evaluator::findOrFail($request->evaluator_id);

        try {
            return new EvaluatorResource($evaluator);
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
            'evaluator_id' => 'required',
            'coordinator_id' => 'required',
            'name' => 'required',
            'contact_email' => 'required',
            'contact_phone' => 'required',
        ]);

        //Image Handling
        $image = $this->upload($request, "image");

        $coordinator = Coordinator::findOrFail($request->coordinator_id);
        $evaluator = Evaluator::findOrFail($request->evaluator_id);

        try {
            $evaluator->coordinator_id = $coordinator->id;
            if (isset($request->image)) {
                $evaluator->image_url = $image['url'];
                $evaluator->image_ext = $image['ext'];
                $evaluator->image_size = $image['size'];
            }
            $evaluator->name = $request->name;
            $evaluator->contact_phone = $request->contact_phone;
            $evaluator->contact_email = $request->contact_email;
            $evaluator->save();

            return new EvaluatorResource($evaluator);
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
            'evaluator_id' => 'required',
        ]);
        $evaluator = Evaluator::findOrFail($request->evaluator_id);

        if(AplicationDetail::where('evaluator_id',$evaluator->id)->get()->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $evaluator->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}
