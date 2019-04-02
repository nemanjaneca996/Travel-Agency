<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if(session()->has('user') && session()->get('user')[0]->naziv=='admin')
            return $next($request);
        else
            return redirect('/404');
    }
}
