<?php

namespace App\Http\Controllers;

use App\Models\costum\dbCreate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $dt = [
            'title' => 'Home',
            'links' => [
                1 => '<link rel="stylesheet" href="/assets/css/home.css">'
            ]
        ];
        return view('Home', $dt);
    }
}