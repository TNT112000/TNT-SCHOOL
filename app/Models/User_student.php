<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_student extends Model
{
    use HasFactory;
    protected $fillable =['username','password','student_id' ];
    
    public function student(){
        return $this->belongsTo(student::class);
    }
}
