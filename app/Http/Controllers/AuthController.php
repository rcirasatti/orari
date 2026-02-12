<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.login');
    }

    public function authenticate(Request $request)
    {
        // Authentication logic here
        // For now, just simulate login
        
        return redirect()->route('dashboard')
            ->with('success', 'Login berhasil!');
    }

    public function demoLogin(Request $request)
    {
        $role = $request->query('role', 'user');
        
        // Store demo role in session
        session(['demo_role' => $role]);
        
        // Redirect to appropriate dashboard
        return match($role) {
            'orlok' => redirect()->route('orlok.dashboard'),
            'verifikator' => redirect()->route('verifikator.dashboard'),
            'superadmin' => redirect()->route('superadmin.dashboard'),
            default => redirect()->route('dashboard'),
        };
    }

    public function logout(Request $request)
    {
        session()->flush();
        return redirect()->route('index')
            ->with('success', 'Logout berhasil!');
    }
}
