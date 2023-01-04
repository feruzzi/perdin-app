<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', [
            'set_active' => 'users',
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.add-user', [
            'set_active' => 'users',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->username);
        $validate = $request->validate([
            'username' => 'required|unique:users|min:5|max:20',
            'password' => 'required|min:5',
            'name' => 'required',
            'role' => 'required'
        ]);
        $validate['password'] = bcrypt($request->password);
        User::create($validate);
        // $request->session()->flash('success', 'Task was successful');
        return redirect('dashboard/users')->with('success', '"Pengguna ' . $request->name . ' Berhasil Ditambahkan"');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit-user', [
            'set_active' => 'users',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required',
            'role' => 'required'
        ]);
        $user = User::find($id);
        if ($request->password) {
            $validate = $request->validate([
                'password' => "required|min:5",
            ]);
            $validate['password'] = bcrypt($request->password);
        } else {
            $validate['password'] = $user->password;
        }
        User::where('id', $id)->update(
            $validate
        );
        return redirect('dashboard/users')->with('success', '"Pengguna ' . $request->name . ' Berhasil Diperbarui"');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        User::destroy($id);
        return redirect('dashboard/users')->with('success', '"Pengguna ' . $user->name . ' Berhasil Dihapus"');
    }
}