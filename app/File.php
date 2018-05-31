<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;

class File extends Model
{
    static function SaveFiles($filesArray, $lectureID){
        foreach ($filesArray as $file){
            $newUrl = preg_replace('/[-: ]/', '', Carbon::now()).'_'.$file->getClientOriginalName();
            $newName = preg_replace('/ /', '_', $file->getClientOriginalName());
            if($file->storeAs('public', $newUrl)){
                $data[] = [
                    'lecture_id' => $lectureID,
                    'file_name' => $newName,
                    'file_url' => $newUrl,
                    'created_at' => now()
                ];
            }
        }
        if(!empty($data)) self::insert($data);
    }
}
