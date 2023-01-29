<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiOrder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $access_token = $request->header('Order_number');

        if ($access_token !== null) {

            return $next($request);
        } else {
            return response()->json([
                'message' => "order_number not send"
            ]);
        }
    }
}
