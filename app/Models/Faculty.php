<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = ['name','code'];

    public function specialized()
    {
        return $this->hasMany(specialized::class);
    }

    public function teacher()
    {
        return $this->hasMany(teacher::class);
    }
    public function classroom()
    {
        return $this->hasMany(classroom::class);
    }
    public function teacher_subject()
    {
        return $this->hasMany(teacher_subject::class);
    }

    

}
