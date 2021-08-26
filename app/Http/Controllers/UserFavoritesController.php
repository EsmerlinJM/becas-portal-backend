<?php

namespace App\Http\Controllers;

use App\Models\UserFavorites;
use Illuminate\Http\Request;

use App\Http\Resources\UserFavoriteResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\NotBelongsTo;
use App\Exceptions\AlreadyExist;
use App\Tools\Tools;
use Carbon\Carbon;

class UserFavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $favoritos = UserFavorites::where('user_id', auth()->user()->id)->get();
            return UserFavoriteResource::collection($favoritos);
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
            'convocatoria_detail_id' => 'required',
        ]);

        $temp = UserFavorites::where('user_id', auth()->user()->id)->where('convocatoria_detail_id', $request->convocatoria_detail_id)->first();

        if(!$temp) {
            try {
                $favorito = new UserFavorites;
                $favorito->user_id = auth()->user()->id;
                $favorito->convocatoria_detail_id = $request->convocatoria_detail_id;
                $favorito->save();

                return new UserFavoriteResource($favorito);
            } catch (\Throwable $th) {
                throw new SomethingWentWrong($th);
            }
        } else {
            throw new AlreadyExist();
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
            'favorite_id' => 'required',
        ]);

        $favorito = UserFavorites::findOrFail($request->favorite_id);

        $this->belongsToUser($favorito);

        try {
            $favorito->delete();
            return Tools::deleted();
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

    public static function belongsToUser(UserFavorites $favorito)
    {
        if ( auth()->user()->id == $favorito->user->id) {
            return true;
        } else {
            throw new NotBelongsTo;
        }
    }
}