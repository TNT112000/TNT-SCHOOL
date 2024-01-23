<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function FormLogin()
    {
        return view('auth.login');
    }
    public function PostLogin(Request $request)
    {
        $data = $request->validate(
            [
                'email' => 'required|string|max:40',
                'password' => 'required|string|max:20',
            ]
        );
       
        if (auth()->attempt($data)) {
            return redirect()->route('home');
        }else {
            return back()->with(['status' => 'Tài khoản hoặc mật khẩu sai']);
        }


    }
    public function Logout()
    {
        Auth::logout();

        return redirect('/'); 
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
