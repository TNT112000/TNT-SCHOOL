<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $data=Role::all();
        return view('admin.pages.role.list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.role.add');
    }

    public function edit(Role $Role)
    {
        return view('admin.pages.role.update');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $Role)
    {
        //
    }

  
    public function update(Request $request, Role $Role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $Role)
    {
        //
    }
}
