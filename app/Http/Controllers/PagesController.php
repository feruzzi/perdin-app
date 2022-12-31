<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function users_page()
    {
        return view('users.index', [
            'set_active' => 'users',
        ]);
    }
}