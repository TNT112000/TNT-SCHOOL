<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Faculty;
use App\Models\Specialized;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total = Subject::count();
        $data = Subject::all();
        return view('admin.pages.subject.list', ['data' => $data, 'total' => $total]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculty = Faculty::all();
        $specialized = Specialized::all();
        return view('admin.pages.subject.add', ['faculty' => $faculty,'specialized'=>$specialized]);
    }

    public function edit(Subject $subject)
    {
        
        $data = Subject::all();
        $faculty = Faculty::all();
        $specialized = Specialized::all();
        return view('admin.pages.subject.update', ['data' => $data, 'faculty' => $faculty,'specialized'=>$specialized] , compact('subject'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|string|max:40',
                'code' => 'required|string|unique:Subjects',
                'faculty_id' => 'exists:faculties,id',
                'specialized_id' =>'exists:specializeds,id',
            ]
        );

        Subject::create($data);
     
        return redirect()->route('subject.create')->with('status', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $Subject)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $data = $request->validate(
            [
                'name' => 'required|string|max:40',
                'faculty_id' => 'exists:faculties,id',
                'specialized_id' => 'required|exists:specializeds,id',
               
            ]
        );

        $subject->update($data);

        return redirect()->route('subject.edit', ['subject' => $subject->id])->with('status', 'Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $Subject)
    {
        $relationships = ['Part_class'];
        $totalRelationships = 0;
        foreach ($relationships as $relationship) {
            $totalRelationships += $Subject->$relationship()->count();
        }
        if ($totalRelationships < 1) {
            $Subject->destroy($Subject->id);
            return redirect()->route('subject.index')->with('status', 'Đã Xóa thành công');
        } else {
            return redirect()->route('subject.index')->with(['delete' => 'Bản ghi này có liên kết dữ liệu với các bản ghi khác vì vậy bạn không thể xóa ?']);
        }
    }
}
