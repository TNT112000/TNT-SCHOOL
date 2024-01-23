<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_teacher extends Model
{
    use HasFactory;

    protected $fillable =['username','password','teacher_id' ];
    
    public function Teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
