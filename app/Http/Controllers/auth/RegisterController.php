<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Models\costum\dbCreate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class RegisterController extends Controller
{
    public function index()
    {
        $dt = [
            'title' => 'Register',
            'links' => [
                1 => '<link rel="stylesheet" href="/assets/css/register.css">',
                2 => '<script src="/assets/js/register.js"></script>',
            ]
        ];
        return view('auth.register', $dt);
    }

    public function store(Request $request)
    {
        $db = new dbCreate;
        //check if DB exists
        !$db->dbExists() ? $db->dbMake() : '';

        $validate = $request->validate([
            'role' => 'required',
            'username' => 'required|max:20|min:3|unique:users|regex:/^\S*$/u',
            'email' => 'required|email:dns|max:50|unique:users',
            'password' => 'required|max:255|min:6'
        ]);
        $validate['password'] = Hash::make($validate['password']);
        $validate['prv'] = 2;

        try {
            User::create($validate);
            $request->session()->flash('reg_success', Lang::get('reg_success'));
        } catch (\Exception $e) {
            $request->session()->flash('reg_failed', Lang::get('reg_failed') . " " . $e->getMessage());
        }

        return redirect('/register');
    }
}