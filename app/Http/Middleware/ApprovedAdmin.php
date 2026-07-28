<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApprovedAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->role === 'admin') {
            if ($user->status === 'pending') {
                return response()->view('auth.pending-approval');
            }

            if ($user->status === 'suspended') {
                return response()->view('auth.suspended');
            }
        }

        return $next($request);
    }
}
