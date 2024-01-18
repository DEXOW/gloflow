<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, String $perm): Response
    {
        $userRole = Auth::user()->role_id;
        $role = DB::table('roles')->where('id', $userRole)->get()->first();

        if ($role->$perm == 0) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
