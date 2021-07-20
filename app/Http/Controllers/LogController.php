<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Tools\ResponseCodes;
use App\Http\Resources\LogResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\AlreadyActive;
use App\Exceptions\AlreadyDeActivated;
use App\Tools\Tools;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $logs = Log::all();
            return LogResource::collection($logs);
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
            'service' => 'required',
            'message' => 'required',
        ]);

        try {
            $log = new Log;
            $log->service = $request->service;
            $log->message = $request->message;
            $log->save();

            return new LogResource($log);
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
            'log_id' => 'required',
        ]);
        $log = Log::findOrFail($request->log_id);
        try {
            return new LogResource($log);
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
    public function search(Request $request)
    {
        $request->validate([
            'initial_date' => 'required',
            'final_date' => 'required',
        ]);

        $service = $request->service;
        $initial_date = $request->initial_date." 00:00:00";
        $final_date = $request->final_date." 23:59:59";

        try {
            $logs = DB::table('logs')
            ->where('created_at', '>=', $initial_date)->where('created_at', '<=', $final_date)
            ->when($request->service, function ($query, $service) {
                return $query->where('service','like','%'.$service.'%');
            })->get();
            return LogResource::collection($logs);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }




}