<?php

namespace App\Http\Controllers;

use App\Models\Ajax;
use App\Models\Classroom;
use App\Models\Specialized;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Teacher_subject;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function showSpecialized(Request $request)
    {

        $id = $request->input('id');
        $data_line = Specialized::where('faculty_id', $id)->get();
        response()->json($data_line);
        return $data_line;
    }
    public function showClass(Request $request)
    {

        $id = $request->input('id');
        $data_line = Classroom::where('specialized_id', $id)->get();
        response()->json($data_line);
        return $data_line;
    }

    public function teacher_subject(Request $request)
    {
        $id = $request->input('id');
        $teacher = Teacher::where('faculty_id', $id)->get();
        $subject = Subject::where('faculty_id', $id)->get();
        $data_line['teacher'] = $teacher;
        $data_line['subject'] = $subject;
        response()->json($data_line);
        return $data_line;
    }
    public function showTeacher(Request $request)
    {
        $id = $request->input('id');
        $subject = Subject::find($id);
        $data_line = $subject->teacher;
        return response()->json($data_line);
    }
    public function showSubject(Request $request)
    {
        $id = $request->input('id');
        $data_line = Subject::where('specialized_id', $id)->get();
        response()->json($data_line);
        return $data_line;
    }

    public function ClassShowSubject(Request $request)
    {
        // $id = $request->input('id');
        // $classroom = Classroom::find($id);
        // $specialized_id = $classroom->specialized_id;
        // $tnt = Specialized::find($specialized_id);
        // $data_line = $tnt->subject;
        // return response()->json($data_line);

        $id = $request->input('id');
        $classroom = classroom::where('specialized_id', $id)->get();
        $subject = Subject::where('specialized_id', $id)->get();
        $data_line['classroom'] = $classroom;
        $data_line['subject'] = $subject;
        response()->json($data_line);
        return $data_line;
    }
}
