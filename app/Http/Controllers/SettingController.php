<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('pages.settings', [
            'userName' => 'Admin Super',
            'userRole' => 'superadmin'
        ]);
    }

    public function update(Request $request)
    {
        // Update general settings
        
        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }

    public function updateEmail(Request $request)
    {
        // Update email settings
        
        return back()->with('success', 'Pengaturan email berhasil disimpan!');
    }
}
