<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $dt = [
            'title' => 'Dashboard',
        ];
        return view('layouts.dashboard', $dt);
    }
}