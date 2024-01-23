<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Role_permission;

class RolePermissionController extends Controller
{
    public function index()
    {
        $data=Role_permission::all();
        return view('admin.pages.role_permission.list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.role_permission.add');
    }

    public function edit(Role_permission $Role_permission)
    {
        return view('admin.pages.role_permission.update');
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
    public function show(Role_permission $Role_permission)
    {
        //
    }

  
    public function update(Request $request, Role_permission $Role_permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role_permission $Role_permission)
    {
        //
    }
}
