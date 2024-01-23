<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialized extends Model
{
    use HasFactory;

    protected $fillable = ['name','code','qty', 'faculty_id'];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
    public function classroom()
    {
        return $this->hasMany(classroom::class);
    }
    public function student()
    {
        return $this->hasMany(student::class);
    }
}
