<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class LoginSession
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
        $ses=Session::get('is_login');
        if($ses==null){
            return redirect('/');
        }
        return $next($request);
    }
}
