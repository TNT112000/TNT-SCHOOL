<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Faculty;
use App\Models\Part_class;
use App\Models\Specialized;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class PartClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total = Part_class::count();
        $data=Part_class::all();
        return view('admin.pages.part_class.list', ['data' => $data, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teacher = Teacher::all();
        $subject = Subject::all();
        $faculty = Faculty::all();
        $specialized = Specialized::all();
        $classroom = Classroom::all();
        return view('admin.pages.part_class.add', ['classroom'=>$classroom,'teacher'=>$teacher,'subject'=>$subject,'faculty' => $faculty,'specialized'=>$specialized]);
    }

    public function edit(Part_class $part_class)
    {
        $teacher = Teacher::all();
        $subject = Subject::all();
        $faculty = Faculty::all();
        $specialized = Specialized::all();
        $classroom = Classroom::all();
        return view('admin.pages.part_class.update', ['part_class'=>$part_class,'classroom'=>$classroom,'teacher'=>$teacher,'subject'=>$subject,'faculty' => $faculty,'specialized'=>$specialized,'part_class'=> $part_class]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|string|max:40|unique:part_classes,name',
                'code' => 'required|string|max:100|unique:students,code|min:10|max:12',
                'faculty_id' => 'exists:faculties,id',
                'specialized_id' =>'exists:specializeds,id',
                'subject_id'=>'exists:subjects,id',
                'teacher_id' => 'exists:teachers,id',
                'classroom_id' => 'exists:classrooms,id',
                'qty'=>'required|numeric|max:150',
            ]
        );

        Part_class::create($data);
     
        return redirect()->route('part_class.create')->with('status', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Part_class $part_class)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Part_class $part_class)
    {
        $data = $request->validate(
            [
                'name' => 'required|string|max:40|unique:part_classes,name,'. $part_class->id,
                'faculty_id' => 'exists:faculties,id',
                'specialized_id' =>'exists:specializeds,id',
                'subject_id'=>'exists:subjects,id',
                'teacher_id' => 'exists:teachers,id',
                'classroom_id' => 'exists:classrooms,id',
                'qty'=>'required|numeric|max:150',
            ]
        );

        $part_class->update($data);

        return redirect()->route('part_class.edit', ['part_class' => $part_class->id])->with('status', 'Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Part_class $part_class)
    {
        $relationships = [];
        $totalRelationships = 0;
        foreach ($relationships as $relationship) {
            $totalRelationships += $part_class->$relationship()->count();
        }
        if ($totalRelationships < 1) {
            $part_class->destroy($part_class->id);
            return redirect()->route('part_class.index')->with('status', 'Đã Xóa thành công');
        } else {
            return redirect()->route('part_class.index')->with(['delete' => 'Bản ghi này có liên kết dữ liệu với các bản ghi khác vì vậy bạn không thể xóa ?']);
        }
        
    }
}
