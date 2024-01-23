<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'code', 'faculty_id', 'gender', 'email'];
    public function Faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function user_teacher()
    {
        return $this->hasOne(User_teacher::class);
    }
    public function subject()
    {
        return $this->belongsToMany(subject::class, 'teacher_subjects','teacher_id','subject_id');
    }
}
