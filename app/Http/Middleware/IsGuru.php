<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class IsGuru
{
    // IsGuru.php
    public function handle(Request $request, Closure $next)
    {

        if (Auth::user()->role == "guru") {
            return $next($request);
        }else{
            return redirect('/dashborad')->with("failed","Anda bukan admin!");
        }
        return redirect('/data')->with('error', 'Akses ditolak.');
    }

}
