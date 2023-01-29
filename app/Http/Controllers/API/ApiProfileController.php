<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResources;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiProfileController extends Controller
{
    public function get(Request $request)
    {
        $access_token=$request->header('Authorization');

        $user = User::where('access_token',"=",$access_token)->first();

        if ($user != null) {
            return response()->json([
                'status' => true,
                "data" => new UserResources($user)
            ]);
        } else {
            return response()->json([
                'status' => false,
                "message" => 'your credientials is not correct'
            ]);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required','email'],
            'phone' => ['required', 'unique:users'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ]);
        }

        $access_token=$request->header('Authorization');

        $user = User::where('access_token',"=",$access_token)->first();

        if ($user != null) {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            return response()->json([
                'status' => true,
                'message' => "Your data updated successfully",
                "data" => new UserResources($user)
            ]);
        } else {
            return response()->json([
                'status' => false,
                "message" => 'your credientials is not correct'
            ]);
        }
    }

    public function change(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ]);
        }

        $access_token=$request->header('Authorization');

        $user = User::where('access_token',"=",$access_token)->first();

        if ($user != null) {
            $password_Correct = Hash::check($request->old_password, $user->password);
            if ($password_Correct) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
                return response()->json([
                    'status' => true,
                    'message' => "Your Password updated successfully",
                    "data" => new UserResources($user)
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    "message" => 'Old Password does not matched'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                "message" => 'your credientials is not correct'
            ]);
        }
    }


}

