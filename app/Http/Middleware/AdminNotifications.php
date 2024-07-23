<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Request as UserRequest;

class AdminNotifications
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->level === 'admin') {
            $pendingRequests = UserRequest::where('status', 'submited')->count();
            view()->share('pendingRequests', $pendingRequests);
        }
    
        return $next($request);
    }
}
