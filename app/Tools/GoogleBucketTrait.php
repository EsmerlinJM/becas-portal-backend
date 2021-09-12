<?php

namespace App\Tools;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Tools\Tools;
use Carbon\Carbon;
use App\Exceptions\SomethingWentWrong;



trait GoogleBucketTrait
{
    public function upload(Request $request, $fileName)
    {

        if (!$request->file($fileName)) {
            return $file = array(
                "name" => null,
                "url" => null,
                "ext" => null,
                "size" => null,
            );
        }

        try {
            // Initialize Google Storage
            $disk = \Storage::disk('google');

            $folder = (env('APP_ENV') != 'production') ? "DESARROLLO" : "PRODUCCION";

            $name = strtoupper('PNB-'.Carbon::now()->format('Y-m-d')."-".time().".".$request->file($fileName)->getClientOriginalExtension());
            $disk->write($folder."/".$name, file_get_contents($request->file($fileName)), ['visibility' => 'public']);

            $file = array(
                "name" => $name,
                "url" => $disk->url($name),
                "ext" => $request->file($fileName)->getClientOriginalExtension(),
                "size" => $request->file($fileName)->getSize(),
            );
            return $file;
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }

}