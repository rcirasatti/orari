<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function userDashboard()
    {
        return view('pages.user-dashboard', [
            'userName' => 'Ahmad Surya',
            'userRole' => 'user',
            'userCallsign' => 'YB1ABC'
        ]);
    }

    public function orlokDashboard()
    {
        return view('pages.orlok-dashboard', [
            'userName' => 'Budi ORLOK',
            'userRole' => 'orlok'
        ]);
    }

    public function verifikatorDashboard()
    {
        return view('pages.verifikator-dashboard', [
            'userName' => 'Verifikator Admin',
            'userRole' => 'verifikator'
        ]);
    }

    public function superadminDashboard()
    {
        return view('pages.superadmin-dashboard', [
            'userName' => 'Admin Super',
            'userRole' => 'superadmin'
        ]);
    }
}
