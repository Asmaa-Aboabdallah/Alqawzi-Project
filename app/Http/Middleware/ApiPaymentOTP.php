<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\payment;
use Illuminate\Http\Request;

class ApiPaymentOTP
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
        $otp=$request->header('paymentOTP');

        if($otp !== null)
        {
            $paymentOTP = payment::where('remember_token',"=",$otp)->first();
            if($paymentOTP !==null)
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
