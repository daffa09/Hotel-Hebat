<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexAdmin()
    {
        //! hanya admin yang bisa mengkases dashboard ini
        $this->middleware('admin');
        $username = auth()->user()->username;
        $active = 'Dashboard';
        $title = "Dashboard";
        return view('dashboard.index', compact('username', 'active', 'title'));
    }

    public function indexResepsionis()
    {
        //! hanya resepsionis yang bisa mengkases dashboard ini
        $this->middleware('resepsionis');
        $username = auth()->user()->username;
        $active = 'Dashboard';
        $title = "Dashboard";
        return view('dashboard.index', compact('username', 'active', 'title'));
    }
}
