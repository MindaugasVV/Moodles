<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    public function Group(){
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function Files(){
        return $this->hasMany(File::class);
    }
}
