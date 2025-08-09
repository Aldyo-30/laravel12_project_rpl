<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleLargeUploads
{
    public function handle(Request $request, Closure $next)
    {
        // Middleware dinonaktifkan, hanya meneruskan request
        return $next($request);
    }
}
