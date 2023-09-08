<?php

namespace App\Http\Middleware;

use App\Models\UserEngagementMetric;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Increment the number of visits for the user (if authenticated)
        if ($user) {
            UserEngagementMetric::updateOrCreate(
                ['user_id' => $user->id],
                ['number_of_visits' => $user->engagementMetric->number_of_visits + 1]
            );
        }
        return $next($request);
    }
}
