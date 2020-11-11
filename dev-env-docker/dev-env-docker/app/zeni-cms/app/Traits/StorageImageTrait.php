<?php
namespace App\Traits;

use App\Models\Post;
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Storage;
use Storage;

trait StorageImageTrait {

    //upload file img
    public function storageTraitUpload($request, $filename, $foderName)
    {
        if($request->hasFile($filename))
        {
            $file = $request->$filename;
            $fileNameOrigin = Str::random(20).$file->getClientOriginalName();
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
    //delete file
    public function deleteFile($id)
    {
        $filename = Post::onlyTrashed()->select('img')->where('id',$id)->first();
        //$filepath = storage_path('posts/'.$filename['img']);
        return Storage::disk('public')->delete('posts/'.$filename['img']);
        
        
    }

}
