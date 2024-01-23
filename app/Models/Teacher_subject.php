<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_subject extends Model
{
    use HasFactory;

    protected $fillable=['subject_id','teacher_id','faculty_id'];
    
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function Faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

}
