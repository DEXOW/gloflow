<?php 

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nette\Utils\ArrayList;
use Closure;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  ArrayList  $role_id
     */
    public function handle(Request $request, Closure $next, int $role_id)
    {
        if (!in_array(auth()->user()->role_id, array($role_id))) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}

?>
