<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait Media
{
    public function uploads($file, $path ,$filename)
    {

            //Storage::disk('public')->put($path . $filename, File::get($file));
            $file->move(public_path('storage/'.$path),$filename);
//            $file_name  = $file->getClientOriginalName();
//            $file_type  = $file->getClientOriginalExtension();
            $filePath   = 'storage/'.$path . $filename;
            
            return  [
                'filePath' => $filePath,
            ];
    }

}