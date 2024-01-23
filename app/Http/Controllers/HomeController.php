<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Faculty;
use App\Models\Part_class;
use App\Models\Specialized;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function Home()
    {
        $part_class=Part_class::count();
        $faculty=Faculty::count();
        $specialized=Specialized::count();
        $classroom=Classroom::count();
        $teacher=Teacher::count();
        $student=Student::count();
        $subject=Subject::count();
        return view('admin.pages.home.home',['part_class'=>$part_class,'faculty'=>$faculty,'specialized'=>$specialized,'classroom'=>$classroom,'teacher'=>$teacher,'student'=>$student,'subject'=>$subject]);
    }
}
