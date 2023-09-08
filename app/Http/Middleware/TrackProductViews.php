<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TrackProductViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->routeIs('product.show')) {
            $productId = $request->route('id'); 
            if ($productId) {
                DB::table('product_views')->insert([
                    'product_id' => $productId,
                    'user_id' => $request->user()->id,
                ]);
            }
        }
        return $next($request);
    }
}
