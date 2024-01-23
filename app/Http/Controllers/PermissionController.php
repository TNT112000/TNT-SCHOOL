<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $data=Permission::all();
        return view('admin.pages.permission.list',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.permission.add');
    }

    public function edit(Permission $Permission)
    {
        return view('admin.pages.permission.update');
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
    public function show(Permission $Permission)
    {
        //
    }

  
    public function update(Request $request, Permission $Permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $Permission)
    {
        //
    }
}
