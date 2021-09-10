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
        try {
            // Initialize Google Storage
            $disk = \Storage::disk('google');

            $name = strtoupper('PNB-'.Carbon::now()->format('Y-m-d')."-".time().".".$request->file($fileName)->getClientOriginalExtension());
            $disk->write($name, file_get_contents($request->file($fileName)), ['visibility' => 'public']);

            $file = array(
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
