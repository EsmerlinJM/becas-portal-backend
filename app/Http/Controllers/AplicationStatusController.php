<?php

namespace App\Http\Controllers;

use App\Models\Aplication;
use App\Models\AplicationStatus;
use Illuminate\Http\Request;

use App\Http\Resources\AplicationStatusResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class AplicationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $statuses = AplicationStatus::all();
            return AplicationStatusResource::collection($statuses);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function closeStatus()
    {
        try {
            $status = AplicationStatus::whereIn('id', [5,6,7,8])->get();
            // return $status;
            return AplicationStatusResource::collection($status);
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
            'aplication_status_id' => 'required',
        ]);

        $status = AplicationStatus::findOrFail($request->aplication_status_id);

        try {
            return new AplicationStatusResource($status);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

}