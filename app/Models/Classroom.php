<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable =['name','code','faculty_id','specialized_id',];
    public function Faculty(){
        return $this->belongsTo(Faculty::class);
    }
    public function Specialized(){
        return $this->belongsTo(Specialized::class);
    }
    public function Student(){
        return $this->hasMany(Student::class);
    }

    


}
