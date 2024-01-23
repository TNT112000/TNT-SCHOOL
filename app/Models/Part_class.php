<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part_class extends Model
{
    use HasFactory;

    protected $fillable=['name','faculty_id','specialized_id','code','subject_id','teacher_id','classroom_id','qty'];
    public function Faculty(){
        return $this->belongsTo(Faculty::class);
    }

    public function Teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function Specialized(){
        return $this->belongsTo(Specialized::class);
    }
    public function Classroom(){
        return $this->belongsTo(Classroom::class);
    }

    public function Subject(){
        return $this->belongsTo(subject::class);
    }

}
