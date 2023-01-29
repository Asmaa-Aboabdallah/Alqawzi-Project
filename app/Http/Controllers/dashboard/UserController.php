<?php

namespace App\Http\Controllers\dashboard;

use App\Models\User;
use App\Models\payment;
use App\Models\C2C_service;
use App\Models\C2P_service;
use App\Models\new_service;
use App\Models\P2C_service;
use App\Models\P2P_service;
use Illuminate\Http\Request;
use App\Models\sub_service_user;
use App\Models\admin_main_upload;
use App\Models\insurance_service;
use App\Models\main_service_user;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\API\ApiNotifation;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::where('role_id', 2)->select('id', 'name', 'phone')->get();
        return view('dashboard.users.index')->with($data);
    }

    public function show_orders($user_id)
    {
        $data['user'] = User::findOrFail($user_id);
        $data['main_orders'] = main_service_user::where('user_id', $data['user']->id)->select('id', 'main_service_id', 'order_number', 'status')->get();
        return view('dashboard.users.show-orders')->with($data);
    }

    public function show_order_details($order_id)
    {
        $data['main_order'] = main_service_user::findOrFail($order_id);
        if($data['main_order']->main_services->id == 1){
            $data['sub_order'] = sub_service_user::where('order_number', $data['main_order']->order_number)->select('id', 'sub_service_id')->first();
            if ($data['sub_order']->sub_services->id == 1) {
                $data['P2P'] = P2P_service::where('subOrder_id',  $data['sub_order']->id)->select('id', 'subOrder_id', 'id_photo_from', 'driving_license_from', 'others_from', 'id_photo_to', 'driving_license_to', 'others_to')->first();
            } elseif ($data['sub_order']->sub_services->id == 2) {
                $data['C2C'] = C2C_service::where('subOrder_id',  $data['sub_order']->id)->select('id', 'subOrder_id','log_image_from','letter_from','driving_license_from','others_from','log_image_to','letter_to','driving_license_to','others_to')->first();
            } elseif ($data['sub_order']->sub_services->id == 3) {
                $data['P2C'] = P2C_service::where('subOrder_id',  $data['sub_order']->id)->select('id', 'subOrder_id','id_photo_from','driving_license_from','others_from','log_image_to','letter_to','driving_license_to','others_to')->first();
            } else {
                $data['C2P'] = C2P_service::where('subOrder_id',  $data['sub_order']->id)->select('id', 'subOrder_id', 'log_image_from', 'letter_from', 'driving_license_from','others_from', 'id_photo_to', 'driving_license_to', 'others_to')->first();
            }
        }elseif($data['main_order']->main_services->id == 2){
            $data['new'] = new_service::where('order_id', $data['main_order']->id)->select('id','order_id','id_photo','form','Examination','others')->first();

        }else{
            $data['insurance'] = insurance_service::where('order_id', $data['main_order']->id)->select('id','order_id','id_photo','form','others')->first();
        }
        return view('dashboard.users.show-orders-details')->with($data);
    }

    public function pendingPayment($order_id)
    {
        $main_order = main_service_user::findOrFail($order_id);
        $main_order->update([
            'status'=> "pendingPayment",
        ]);
        return back();
    }

    public function pendingOTPConfirmation($order_id)
    {
        $main_order = main_service_user::findOrFail($order_id);

        $main_order->update([
            'status'=> "pendingOTPConfirmation",
        ]);
        return back();
    }

    // public function otpConfirmed($order_id)
    // {
    //     $main_order = main_service_user::findOrFail($order_id);

    //     $main_order->update([
    //         'status'=> "otpConfirmed",
    //     ]);
    //     return back();
    // }

    public function completed($order_id)
    {
        $main_order = main_service_user::findOrFail($order_id);

        $main_order->update([
            'status'=> "completed",
        ]);
        return back();
    }


    public function adminUpload($order_id){
        $data['main_order'] = main_service_user::findOrFail($order_id);
        return view('dashboard.users.admin-uploads')->with($data);
    }

    public function storeUploads($order_id , Request $request){
        // dd($request->all());

        $main_order = main_service_user::findOrFail($order_id);
        $request->validate([
            'image' => 'required|array',
            'image.*' => 'required|image|max:2048'
        ]);

        // dd($request->file('image')[0]);

        for ($i=0; $i < count($request->image) ; $i++) {
            $path = Storage::putFile("files", $request->file('image')[$i]);
            admin_main_upload::create([
                    'order_id' => $main_order->id,
                    'order_number' => $main_order->order_number,
                    'admin_uploads' => $path,
                ]);
        }
        return redirect('dashboard/uploads');
    }


    public function payment($user_id)
    {
        $data['user'] = User::findOrFail($user_id);

        $data['payment'] = payment::where('user_id', $data['user']->id)->select('id','user_id','order_number','payment_receipt','card_number','amount','expire_date')->get();
        return view('dashboard.users.payment')->with($data);
    }

}
