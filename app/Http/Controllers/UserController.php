<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('pages.users-list', [
            'userName' => 'Admin Super',
            'userRole' => 'superadmin'
        ]);
    }
}
