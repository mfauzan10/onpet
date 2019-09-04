<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CustomerAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Session::get('type-customer') != 'customer')
        {
            return redirect('/');
        }
        return $next($request);
    }
}
