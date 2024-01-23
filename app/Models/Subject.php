<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'faculty_id', 'specialized_id',];
    public function Faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
    public function Specialized()
    {
        return $this->belongsTo(Specialized::class);
    }
    public function Part_class()
    {
        return $this->hasMany(Part_class::class);
    }

    public function teacher()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_subjects', 'subject_id', 'teacher_id');
    }
}
