<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Teacher;
use App\Models\User_teacher;
use Illuminate\Http\Request;
use App\Mail\ExampleMail;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Jobs\SendEmail;
use App\Models\Classroom;
use App\Models\Specialized;
use App\Models\Subject;
USE Illuminate\Support\Facades\Redis;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
       
        $total = Teacher::count();
        $data = Teacher::all();
        return view('admin.pages.teacher.list', ['data' => $data, 'total' => $total]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
        $total = Teacher::count();
        $faculty = Faculty::all();
        return view('admin.pages.teacher.add', ['faculty' => $faculty, 'total' => $total]);
    }

    public function edit(Teacher $teacher)
    {
        $faculty = Faculty::all();
        return view('admin.pages.teacher.update', ['faculty' => $faculty], compact('teacher'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|string|max:40',
                'code' => 'required|string|max:100|unique:teachers,code|min:10|max:12',
                'faculty_id' => 'exists:faculties,id',
                // 'email' => 'required|email|unique:teachers,email',
                'gender' => 'required',
            ]
        );

        // $faculty = $request->input('faculty_id');

        // $faculty_id = Faculty::where('name', $faculty)->value('id');

        // $data['faculty_id'] = $faculty_id;
        $hashedPassword = Hash::make($data['code']);

        $randomString = Str::random(rand(3, 10));

        $finalPassword = hash_hmac('sha256', $hashedPassword, $randomString);

        $finalPassword = substr($finalPassword, 0, rand(12, 15));

        $data['password']=$finalPassword;

        $id = Teacher::create($data);


        

        $user = [
            'username' => $data['code'],
            'password' => $data['password'],
            'code' => $data['code'],
            'teacher_id' => $id->id,
            // 'email'=>$data['email']
        ];
        // dispatch(new SendEmail($user));
        
        User_teacher::create($user);
        // $email = new ExampleMail($user);
        // $email->Send_user();
        // Mail::to($data['email'])->send($email);
        return redirect()->route('teacher.create')->with('status', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $Teacher)
    {
        //
    }


    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate(
            [
                'name' => 'required|string|max:40',
                'faculty_id' => 'exists:faculties,id',
                // 'email' => 'required|email|unique:teachers,email'.$teacher->id,
                'gender' => 'required',
            ]
        );

        $teacher->update($data);

        return redirect()->route('teacher.edit', ['teacher' => $teacher->id])->with('status', 'Chỉnh sửa thành công');
    }

    
    public function destroy(Teacher $teacher)
    {
        
        $relationships = ['user_teacher'];
        $totalRelationships = 0;
        foreach ($relationships as $relationship) {
            $totalRelationships += $teacher->$relationship()->count();
        }
        if ($totalRelationships < 1) {
            $teacher->destroy($teacher->id);
            return redirect()->route('teacher.index')->with('status', 'Đã Xóa thành công');
        } else {
            return redirect()->route('teacher.index')->with(['delete' => 'Bản ghi này có liên kết dữ liệu với các bản ghi khác vì vậy bạn không thể xóa ?']);
        }

    }
    
}
