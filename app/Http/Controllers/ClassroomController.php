<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Faculty;
use App\Models\Specialized;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total = Classroom::count();
        $data = Classroom::all();
        return view('admin.pages.classroom.list', ['data' => $data, 'total' => $total]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculty = Faculty::all();
        $specialized = Specialized::all();
        return view('admin.pages.classroom.add', ['faculty' => $faculty,'specialized'=>$specialized]);
    }

    public function edit(Classroom $classroom)
    {
        
        $data = classroom::all();
        $faculty = Faculty::all();
        $specialized = Specialized::all();
        return view('admin.pages.classroom.update', ['data' => $data, 'faculty' => $faculty,'specialized'=>$specialized] , compact('classroom'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|string|max:40',
                'code' => 'required|string|unique:classrooms',
                'faculty_id' => 'exists:faculties,id',
                'specialized_id' =>'exists:specializeds,id',
            ]
        );

        Classroom::create($data);
     
        return redirect()->route('subject.create')->with('status', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $data = $request->validate(
            [
                'name' => 'required|string|max:40',
                'faculty_id' => 'exists:faculties,id',
                'specialized_id' => 'required|exists:specializeds,id',
               
            ]
        );

        $classroom->update($data);

        return redirect()->route('classroom.edit', ['classroom' => $classroom->id])->with('status', 'Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $relationships = ['Student'];
        $totalRelationships = 0;
        foreach ($relationships as $relationship) {
            $totalRelationships += $classroom->$relationship()->count();
        }
        if ($totalRelationships < 1) {
            $classroom->destroy($classroom->id);
            return redirect()->route('classroom.index')->with('status', 'Đã Xóa thành công');
        } else {
            return redirect()->route('classroom.index')->with(['delete' => 'Bản ghi này có liên kết dữ liệu với các bản ghi khác vì vậy bạn không thể xóa ?']);
        }
    }
}
