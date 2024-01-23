<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Faculty;
use App\Models\Specialized;
use App\Models\student;
use App\Models\User_student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $total = student::count();
        $data = student::all();
        return view('admin.pages.student.list', ['data' => $data, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classroom = Classroom::all();
        $faculty = Faculty::all();
        $specialized = Specialized::all();
        return view('admin.pages.student.add', ['classroom'=>$classroom,'faculty' => $faculty,'specialized'=>$specialized]);
    }

    public function edit(Student $student)
    {
        $classroom = Classroom::all();
        $data = student::all();
        $faculty = Faculty::all();
        $specialized = Specialized::all();
        return view('admin.pages.student.update', ['classroom'=>$classroom,'data' => $data, 'faculty' => $faculty,'specialized'=>$specialized] , compact('student'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|string|max:40',
                'code' => 'required|string|max:100|unique:students,code|min:10|max:12',
                'faculty_id' => 'exists:faculties,id',
                'specialized_id' =>'exists:specializeds,id',
                'classroom_id'=>'exists:classrooms,id',
                'gender' => 'required',
            ]
        );

       
        $hashedPassword = Hash::make($data['code']);

        $randomString = Str::random(rand(3, 10));

        $finalPassword = hash_hmac('sha256', $hashedPassword, $randomString);

        $finalPassword = substr($finalPassword, 0, rand(12, 15));

        $data['password']=$finalPassword;

        $id = student::create($data);


        

        $user = [
            'username' => $data['code'],
            'password' => $data['password'],
            'code' => $data['code'],
            'student_id' => $id->id,
            
        ];
        
        
        User_student::create($user);
     
        return redirect()->route('student.create')->with('status', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $Student)
    {
        
    }

  
    public function update(Request $request, Student $student)
    {
        $data = $request->validate(
            [
                'name' => 'required|string|max:40',
                'faculty_id' => 'required|exists:faculties,id',
                'specialized_id' =>'required|exists:specializeds,id',
                'classroom_id'=>'required|exists:classrooms,id',
                'gender' => 'required',
               
            ]
        );

        $student->update($data);

        return redirect()->route('student.edit', ['student' => $student->id])->with('status', 'Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $relationships = ['User_student'];
        $totalRelationships = 0;
        foreach ($relationships as $relationship) {
            $totalRelationships += $student->$relationship()->count();
        }
        if ($totalRelationships < 1) {
            $student->destroy($student->id);
            return redirect()->route('student.index')->with('status', 'Đã Xóa thành công');
        } else {
            return redirect()->route('student.index')->with(['delete' => 'Bản ghi này có liên kết dữ liệu với các bản ghi khác vì vậy bạn không thể xóa ?']);
        }

    }
}
