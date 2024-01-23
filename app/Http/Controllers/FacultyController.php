<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Faculty::all();
        return view('admin.pages.faculty.add', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $total = faculty::count();
        $data = faculty::all();

        return view('admin.pages.faculty.add', ['data' => $data, 'total' => $total]);
    }

    public function edit(faculty $faculty)
    {
        $total = $faculty->count();
        $data = faculty::all();
        return view('admin.pages.faculty.update', ['data' => $data, 'total' => $total], compact('faculty'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|string|max:40|unique:faculties,name',
                'code' => 'required|string|max:100|unique:faculties,code',
            ]
        );

        Faculty::create($data);
        return redirect()->route('faculty.create')->with('status', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty)
    {
        $data = $request->validate([
            'name' => 'required|string|max:40|unique:faculties,name,' . $faculty->id,
            'code' => 'required|string|max:100',
        ]);
        $faculty->update($data);
        return redirect()->route('faculty.edit', ['faculty' => $faculty->id])->with('status', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty)
    {

        $relationships = ['teacher', 'specialized'];
        $totalRelationships = 0;
        foreach ($relationships as $relationship) {
            $totalRelationships += $faculty->$relationship()->count();
        }

        if ($totalRelationships < 1) {
            $faculty->destroy($faculty->id);
            return redirect()->route('faculty.create')->with('status', 'Đã Xóa thành công');
        } else {
            return redirect()->route('faculty.create')->with(['delete' => 'Bản ghi này có liên kết dữ liệu với các bản ghi khác vì vậy bạn không thể xóa ?']);
        }
    }

    // public function destroy_all(Faculty $faculty)
    // {
    //     $relationships = ['teacher', 'specialized'];
    //     foreach ($relationships as $relationship) {
    //         $relatedModels = $faculty->$relationship;

        
    //     foreach ($relatedModels as $relatedModel) {
    //         $relatedModel->delete();
    //     }
    //     }
    //     $faculty->destroy($faculty->id);
    //     return redirect()->route('faculty.create')->with('status', 'Đã Xóa thành công');
    // }
}
