<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function create()
    {
        return view('pages.pengajuan-form', [
            'userName' => 'Ahmad Surya',
            'userRole' => 'user',
            'userCallsign' => 'YB1ABC'
        ]);
    }

    public function store(Request $request)
    {
        // Data validation logic here
        // For now, just redirect with success message
        
        return redirect()->route('pengajuan.history')
            ->with('success', 'Pengajuan berhasil dikirim!');
    }

    public function history()
    {
        return view('pages.pengajuan-history', [
            'userName' => 'Ahmad Surya',
            'userRole' => 'user',
            'userCallsign' => 'YB1ABC'
        ]);
    }

    public function list()
    {
        return view('pages.pengajuan-list', [
            'userName' => 'Budi ORLOK',
            'userRole' => 'orlok'
        ]);
    }

    public function all()
    {
        return view('pages.pengajuan-all', [
            'userName' => 'Admin Super',
            'userRole' => 'superadmin'
        ]);
    }

    public function verify()
    {
        return view('pages.pengajuan-verifikasi', [
            'userName' => 'Verifikator Admin',
            'userRole' => 'verifikator'
        ]);
    }

    public function submitVerification(Request $request)
    {
        // Validation and verification logic here
        
        return redirect()->route('pengajuan.list')
            ->with('success', 'Verifikasi berhasil disimpan!');
    }
}
