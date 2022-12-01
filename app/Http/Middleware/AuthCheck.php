<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCheck
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
        if ( !Auth::check() && $request->path() != '/' ) {
            return redirect()->route('login_view')->with('error', 'Yoy must be logged in.');
        }

        if ( Auth::check() && $request->path() == '/' ) {
            Auth::logout();
            return back();
        }

        return $next($request);
    }
}
