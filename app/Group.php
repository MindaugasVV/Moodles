<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function Course(){
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function Teacher(){
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function Users(){
        return $this->belongsToMany(User::class);
    }
}
