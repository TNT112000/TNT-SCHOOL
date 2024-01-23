<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Teacher_subject;
use Illuminate\Http\Request;

class TeacherSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $total = teacher_subject::count();
        $data = teacher_subject::all();
        $faculty= Faculty::all();
        $teacher = Teacher::all();
        $subject = Subject::all();
        return view('admin.pages.teacher_subject.add', ['faculty'=>$faculty,'teacher'=>$teacher,'subject'=>$subject,'data' => $data, 'total' => $total]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                
                'teacher_id' => 'exists:teachers,id',
                'faculty_id' =>'exists:faculties,id',
                'subject_id' => 'exists:subjects,id',
            ]
        );

        Teacher_subject::create($data);
     
        return redirect()->route('teacher_subject.create')->with('status', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher_subject $teacher_subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher_subject $teacher_subject)
    {
        $total = teacher_subject::count();
        $data = teacher_subject::all();
        $faculty= Faculty::all();
        $teacher = Teacher::all();
        $subject = Subject::all();
        return view('admin.pages.teacher_subject.update', ['faculty'=>$faculty,'teacher'=>$teacher,'subject'=>$subject,'data' => $data, 'total' => $total,'teacher_subject'=>$teacher_subject]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher_subject $teacher_subject)
    {
        $data = $request->validate(
            [
                'teacher_id' => 'exists:teachers,id',
                'faculty_id' =>'exists:faculties,id',
                'subject_id' => 'exists:subjects,id',
            ]
        );

        $teacher_subject->update($data);
     
        return redirect()->route('teacher_subject.edit',['teacher_subject'=>$teacher_subject])->with('status', 'Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher_subject $teacher_subject)
    {
        $relationships = [];
        $totalRelationships = 0;
        foreach ($relationships as $relationship) {
            $totalRelationships += $teacher_subject->$relationship()->count();
        }
        if ($totalRelationships < 1) {
            $teacher_subject->destroy($teacher_subject->id);
            return redirect()->route('teacher_subject.create')->with('status', 'Đã Xóa thành công');
        } else {
            return redirect()->route('teacher_subject.create')->with(['delete' => 'Bản ghi này có liên kết dữ liệu với các bản ghi khác vì vậy bạn không thể xóa ?']);
        }
    }
}
