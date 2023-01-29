<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class ApiOTP
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
        $otp=$request->header('Authorization');

        if($otp !== null)
        {
            $user = User::where('otp',"=",$otp)->first();
            if($user !==null)
            {
                return $next($request);

            }else{
                return response()->json([
                    'message'=>"otp not valid"
                ]);
            }

        }else{
            return response()->json([
                'message'=>"otp not sent"
            ]);
        }
    }
}
