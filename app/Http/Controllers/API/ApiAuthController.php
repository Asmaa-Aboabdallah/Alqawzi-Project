<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResources;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'phone' => ['required', 'unique:users'],
            'email' => ['required','string', 'email'],
            'password' => ['required', 'string', 'min:8']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->all(),
            ],409);

        }
        $access_token = Str::random(64);
        // dd($access_token);

        $new_account = User::create([
            'role_id'=>2,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $new_account->update([
            'access_token'=> $access_token,
            // 'device_token'=>,
        ]);
        if ($new_account) {
            return response()->json([
                'message' => "you are successfully registration",
                'token' => $new_account->access_token
            ]);
        } else {
            return response()->json([
                'message' => "you are failed registration "
            ],409);
        }
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => ['required'],
            'password' => ['required', 'string', ' min:5']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->all(),
            ],409);

        }
        $user = User::where('phone', $request->phone)->first();


        if ($user !== null) {
            $password_Correct = Hash::check($request->password, $user->password);
            if ($password_Correct) {
                $access_token = Str::random(64);

                $user->update([
                    'access_token' => $access_token,
                    // 'device_token'=>,
                ]);
                return response()->json([
                    'status' => true,
                    'message' => "You have been login successfully",
                    "data" => new UserResources($user)
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'error' => ['Password Not Correct'],
                ],409);
            }
        } else {
            return response()->json([
                'status' => false,
                'error' => ['Phone not correct'],
            ],409);
        }
    }



    public function logout(Request $request)
    {
        $access_token=$request->header('Authorization');

        $user = User::where('access_token',"=",$access_token)->first();

        $user->update([
            'access_token' => Null
        ]);
        return response()->json([
            'status' => true,
            'message' => 'User Successfully logged out',
        ]);

    }
}
