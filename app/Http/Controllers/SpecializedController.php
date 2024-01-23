<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\Faculty;
use App\Models\Specialized;
use Illuminate\Http\Request;

class SpecializedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Specialized::all();
        return view('admin.pages.specialized.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $total = Specialized::count();
        $data = Specialized::all();
        $faculty = Faculty::all();
        return view('admin.pages.specialized.add', ['data' => $data, 'total' => $total, 'faculty' => $faculty]);
    }

    public function edit(Specialized $specialized)
    {
        $total = $specialized->count();
        $data = Specialized::all();
        $faculty = Faculty::all();
        return view('admin.pages.specialized.update', ['data' => $data, 'total' => $total, 'faculty' => $faculty], compact('specialized'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->validate(
            [
                'name' => 'required|string|max:40|unique:specializeds,name',
                'code' => 'required|string|max:100|unique:specializeds,code',
                'faculty_id' => 'exists:faculties,id',
                'qty' => 'required|numeric',
            ]
        );
       
        // $faculty = $request->input('faculty_id');
       
        // $faculty_id = Faculty::where('name', $faculty)->value('id');
        
        // $data['faculty_id'] = $faculty_id;
        Specialized::create($data);
        return redirect()->route('specialized.create')->with('status', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialized $Specialized)
    {
        //
    }


    public function update(Request $request, Specialized $Specialized)
    {
        $data = $request->validate(
            [
                'name' => 'required|string|max:40|unique:specializeds,name,'. $Specialized->id,
                'faculty_id' => 'exists:faculties,id',
                'qty' => 'required|numeric',
            ]
        );

        // $faculty = $request->input('faculty_id');
       
        // $faculty_id = Faculty::where('name', $faculty)->value('id');
        
        // $data['faculty_id'] = $faculty_id;

        $Specialized->update($data);

        return redirect()->route('specialized.edit',['specialized'=> $Specialized->id])->with('status', 'Chỉnh sửa thành công');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialized $specialized)
    {
        $relationships = ['classroom'];
        $totalRelationships = 0;
        foreach ($relationships as $relationship) {
            $totalRelationships += $specialized->$relationship()->count();
        }

        if ($totalRelationships < 1) {
            $specialized->destroy($specialized->id);
            return redirect()->route('specialized.create')->with('status', 'Đã Xóa thành công');
        } else {
            return redirect()->route('specialized.create')->with(['delete' => 'Bản ghi này có liên kết dữ liệu với các bản ghi khác vì vậy bạn không thể xóa ?']);
        }

    }
}
