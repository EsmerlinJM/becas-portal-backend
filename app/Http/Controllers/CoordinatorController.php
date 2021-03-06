<?php

namespace App\Http\Controllers;

use App\Models\Coordinator;
use App\Models\User;
use App\Models\Evaluator;
use Illuminate\Http\Request;

use Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Resources\CoordinatorResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\EmailNotValid;
use App\Tools\Tools;
use Carbon\Carbon;

use App\Tools\GoogleBucketTrait;

class CoordinatorController extends Controller
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
            $coordinators = Coordinator::all();
            return CoordinatorResource::collection($coordinators);
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
            'email' => 'required|unique:users',
            'password'  => 'required|confirmed',
            'phone' => 'required',
        ]);

        //Image Handling
        $image = $this->upload($request, "image");

        try {
            $user = new User;
            $user->email = $request->email;
            $user->role_id = Tools::COORDINADOR;
            $user->password = Hash::make($request->password);
            $user->save();

            $coordinator = new Coordinator;
            $coordinator->user_id = $user->id;
            $coordinator->image_url = $image['url'];
            $coordinator->image_ext = $image['ext'];
            $coordinator->image_size = $image['size'];
            $coordinator->name = $request->name;
            $coordinator->contact_phone = $request->phone;
            $coordinator->contact_email = $request->email;
            $coordinator->save();

        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }

            try {
                event(new Registered($user));
            } catch (\Throwable $th) {
                $coordinator->forceDelete();
                $user->forceDelete();
                throw new EmailNotValid;
            }

            return new CoordinatorResource($coordinator);
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
            'coordinator_id' => 'required',
        ]);

        $coordinator = Coordinator::findOrFail($request->coordinator_id);

        try {
            return new CoordinatorResource($coordinator);
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
            'coordinator_id' => 'required',
            'name' => 'required',
            'contact_email' => 'required',
            'contact_phone' => 'required',
        ]);

        //Image Handling
        $image = $this->upload($request, "image");

        $coordinator = Coordinator::findOrFail($request->coordinator_id);

        try {
            if(isset($request->image)) {
                $coordinator->image_url = $image['url'];
                $coordinator->image_ext = $image['ext'];
                $coordinator->image_size = $image['size'];
            }
            $coordinator->name = $request->name;
            $coordinator->contact_phone = $request->contact_phone;
            $coordinator->contact_email = $request->contact_email;
            $coordinator->save();

            return new CoordinatorResource($coordinator);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'coordinator_id' => 'required',
        ]);
        $coordinator = Coordinator::findOrFail($request->coordinator_id);

        if($coordinator->evaluators()->count() > 0) {
            return Tools::notAllowed();
        } else {
            try {
                $coordinator->delete();
                return Tools::deleted();
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        }
    }
}