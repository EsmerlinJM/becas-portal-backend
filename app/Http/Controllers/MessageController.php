<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

use App\Http\Resources\MessageResource;
use App\Exceptions\SomethingWentWrong;
use App\Tools\Tools;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if($request->status) {
                if($request->status == 'read') {
                    $messages = Message::where('read',true)->get();
                } else {
                    //unread
                    $messages = Message::where('read',false)->get();
                }
            } else {
                $messages = Message::all();
            }
            return MessageResource::collection($messages);
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
            'email' => 'required',
            'message' => 'required',
        ]);
        try {
            $message = new Message;
            $message->name = $request->name;
            $message->email = $request->email;
            $message->message = $request->message;
            $message->save();

            return new MessageResource($message);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Update to read message
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function markRead(Request $request)
    {
        $request->validate([
            'message_id' => 'required',
        ]);

        $message = Message::findOrFail($request->message_id);

        try {
            $message->read = true;
            $message->save();
            return new MessageResource($message);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    /**
     * Update to un-read message
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function markUnRead(Request $request)
    {
        $request->validate([
            'message_id' => 'required',
        ]);

        $message = Message::findOrFail($request->message_id);

        try {
            $message->read = false;
            $message->save();
            return new MessageResource($message);
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
            'message_id' => 'required',
        ]);

        $message = Message::findOrFail($request->message_id);
        try {
            return new MessageResource($message);
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
            'message_id' => 'required',
        ]);

        $message = Message::findOrFail($request->message_id);
        try {
            $message->delete();
            return Tools::deleted();
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }
}