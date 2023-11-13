<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscriptionAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $subscriptionType): Response
    {
        $user = Session::get('user');

        if ($user && !$user->isSuperAdmin()) {



            // Check if the user has a subscription of the specified type
            if ($user->hasSubscription($subscriptionType)) {
                return $next($request);
            }
        }

        return redirect('https://aceamcq.com/#SUBSCRIBE')->with('error', 'Access denied. User must have a valid subscription for this content.');

    }
}
