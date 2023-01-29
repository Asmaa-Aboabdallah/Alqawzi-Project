<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ForgetResource;
use App\Mail\forgotResponseMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use League\OAuth2\Client\Provider\Google;
use PHPMailer\PHPMailer\OAuth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use Vonage\Laravel\Facade\Vonage;

class ApiForgetController extends Controller
{

    // private $email;
    // private $name;
    // private $client_id;
    // private $client_secret;
    // private $provider;

    // public function __construct()
    // {
    //     $this->email = 'alquzimotors@gmail.com';
    //     $this->name = 'Al-Quzi Foundation';
    //     $this->client_id =  env('GMAIL_API_CLIENT_ID');
    //     $this->client_secret = env('GMAIL_API_CLIENT_SECRET');
    //     $this->provider = new Google(
    //         [
    //             'clientId' => $this->client_id,
    //             'clientSecret' => $this->client_secret
    //         ]
    //     );
<<<<<<< HEAD

    // }

=======
        
    // }
   
>>>>>>> 6812f19be9f30f713fd59d76317d350a33d89878
    public function forgot(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string','email'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->all()
            ], 409);
        }

        $user = User::where('email', $request->email)->first();
        if ($user != null) {
            $receiverMail = $request->email;
            $otp = random_int(1000, 9999);
            $user->update([
                'otp' => $otp,
            ]);

            Mail::to($receiverMail)->send(new forgotResponseMail($otp));
            return response()->json([
                'status' => true,
                "data" => new ForgetResource($user)
            ]);
        } else {
            return response()->json([
                'status' => false,
                "error" => ['your phone is not coorect']
            ]);
        }
    }

    public function otp($otp)
    {
        $user = User::where('otp', $otp)->first();

        if ($user !== Null) {

            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ], 409);
        }
    }
    public function reset(Request $request,$otp)
    {

        $user = User::where('otp', $otp)->first();


        $validator = Validator::make($request->all(), [
            'password' => ['required', 'min:8'],

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()->all()
            ]);
        }

        $update = $user->update([
            'password' => Hash::make($request->password)
        ]);
        if ($update) {
            $user->update([
                'otp' => null,
            ]);
            return response()->json([
                'status' => true,
                'message' => "Password update successfully",
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => ["Password update faild"],
            ]);
        }
    }
}
