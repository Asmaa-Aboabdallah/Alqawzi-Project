<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class ApiAuthenticate
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
        $access_token=$request->header('Authorization');

        if($access_token !== null)
        {
            $user = User::where('access_token',"=",$access_token)->first();
            if($user !==null)
            {
                return $next($request);

            }else{
                return response()->json([
                    'message'=>"token not valid"
                ]);
            }

        }else{
            return response()->json([
                'message'=>"token not sent"
            ]);
        }
    }
}
