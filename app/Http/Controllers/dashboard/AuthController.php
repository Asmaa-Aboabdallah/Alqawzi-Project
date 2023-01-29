<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('dashboard.auth.login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'phone' => ['required', 'string'],
            'password' => ['required','string','min:8']
        ]);

        $user = User::where('phone', $request->phone)->first();
        // dd($user);


        if ($user == null) {
            $request->session()->flash('error-msg', 'invalid your phone');
            return back();
        }else{
            $islogin = Auth::attempt(['phone' => $request->phone, 'password' => $request->password], $request->remember);
        }
       
        if (!$islogin) {
            //flash session
            $request->session()->flash('error-msg', 'credentials not correct');
            return back();
        } else {
            $request->session()->flash('success-msg', 'You are login now');
            return redirect(url('/dashboard'));
        }
    }

    public function forget()
    {
        return view('dashboard.auth.forget');
    }

    public function authPhone(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string'],
        ]);

        $user = User::where('phone',$request->phone)->first();
        if ($user) {
            $receiverPhone = $request->phone;
            $otp = random_int(1000, 9999);
            $user->update([
                'otp' => $otp,
            ]);

            $basic  = new \Vonage\Client\Credentials\Basic("5fda2890", "d8oQEEVeAmQ5EfkT");
            $client = new \Vonage\Client($basic);

            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS("2$receiverPhone", "15556666666", "Your OTP is $otp for verification")
            );

            return redirect(url('/reset_route'));
        } else {
            $request->session()->flash('error-msg', "Enter vaild Phone Number");
            return back();
        }
    }

    public function reset_route(){
        return view('dashboard.auth.reset');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        $user = User::where('otp', $request->otp)->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password),
            ]); 
            return redirect(url('/'));
        }else{
            $request->session()->flash('error-msg', "uncorrect the otp code");
            return back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url('/'));
    }
}
