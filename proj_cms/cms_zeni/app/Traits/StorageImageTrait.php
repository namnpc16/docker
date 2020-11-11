<?php
namespace App\Traits;

use Illuminate\Support\Str;
use Storage;

trait StorageImageTrait {
    public function storageTraitUpload($request, $filename, $foderName)
    {
        if($request->hasFile($filename))
        {
            $file = $request->$filename;
            $fileNameOrigin = $file->getClientOriginalName();
            //$filenameHash = Str::random(20). '.' .$file->getClientOriginalExtension();
            $filePath = $request->file($filename)->storeAs('public/'. $foderName , $fileNameOrigin); //$filenameHash
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $dataUploadTrait;
        }
        return null;
    }
}
