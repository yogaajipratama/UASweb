<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Models\costum\dbCreate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class LoginController extends Controller
{
    public function index()
    {
        $dt = [
            'title' => 'Login',
            'links' => [
                1 => '<link rel="stylesheet" href="/assets/css/login.css">',
                2 => '<script src="/assets/js/login.js"></script>',
            ]
        ];
        return view('auth.login', $dt);
    }

    public function authenticate(Request $request)
    {
        $db = new dbCreate;
        //check if DB exists
        !$db->dbExists() ? $db->dbMake() : '';

        $credentials = $request->validate([
            'email_user' => ['required'],
            'password' => ['required'],
        ]);

        $fieldType = filter_var($request->email_user, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt(array($fieldType => $credentials['email_user'], 'password' => $credentials['password']))) {
            $request->session()->regenerate();
            $request->session()->flash('logSuccess', Lang::get('logSuccess'));
            $request->session()->put('user', auth()->user());

            return redirect('/');
            // return redirect()->intended('/');
        }
        $request->session()->flash('logError', Lang::get('logError'));
        return redirect('/login');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}