<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class MyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $uri = $request->path();
        $method = $request->method();
        if ($method == 'GET') {
            if ($uri == 'login') {
                // if want to get to login, make sure has no "user" session variable
                if (session()->has('user')) {
                    return redirect('/'); //redirect to home if already logged in
                }
            } else {
                if (!session()->has('user')) {
                    $request->session()->flash('forbidPage', Lang::get('forbidPage'));
                    return redirect('/login');
                }
            }
        } else {
            if (!session()->has('user')) {
                $request->session()->flash('forbidPage', Lang::get('forbidPage'));
                return redirect('/login');
            }
        }

        return $next($request);
    }
}