<?php

namespace App\Http\Middleware;

use Closure;

class HasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = $request->user();

        if ( $user->role_id > 0 && $user->permissions()->contains('slug', $permission) ) {

            return $next($request);

        }

        session()->flash( 'warning', 'You do not have permission to access that page.' );

        return redirect('/');
    }
}
