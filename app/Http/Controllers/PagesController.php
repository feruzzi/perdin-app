<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index()
    {
        return view('index', []);
    }
    public function dashboard()
    {
        $waiting = Trip::where('status', 0)->count();
        $approve = Trip::where('status', 1)->count();
        $reject = Trip::where('status', 2)->count();

        return view('dashboard.index', [
            'set_active' => "dashboard",
            'waiting' => $waiting,
            'approve' => $approve,
            'reject' => $reject
        ]);
    }
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();
            if (auth()->user()->role == "0") {
                return redirect()->intended('dashboard');
            } else {
                return redirect()->intended('perdinku');
            }
        }
        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();

        //     return redirect()->intended('dashboard');
        // }
        return back()->withErrors([
            'username' => 'Username dan Password Tidak Valid',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}