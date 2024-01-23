<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable=['name','faculty_id','specialized_id','code','classroom_id'];
    public function Faculty(){
        return $this->belongsTo(Faculty::class);
    }

    public function User_student(){
        return $this->hasOne(User_student::class);
    }

    public function Specialized(){
        return $this->belongsTo(Specialized::class);
    }

    public function Classroom(){
        return $this->belongsTo(Classroom::class);
    }


}
