<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class MyAuthAdmin
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
        if ((!session()->has('user')) || (session('user')->role != '0' && session('user')->role != '1')) {
            $request->session()->flash('forbidAdminPage', Lang::get('forbidAdminPage'));
            return redirect('/');
        } else {
            return $next($request);
        }
    }
}