<?php

namespace App\Http\Controllers\api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\payment;
use App\Models\C2C_service;
use App\Models\C2P_service;
use App\Models\new_service;
use App\Models\P2C_service;
use App\Models\P2P_service;
use App\Models\sub_service;
use Illuminate\Support\Str;
use App\Models\main_service;
use Illuminate\Http\Request;
use App\Mail\forgotResponseMail;
use App\Models\sub_service_user;
use App\Models\admin_main_upload;
use App\Models\insurance_service;
use App\Models\main_service_user;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\orderResource;
use App\Http\Resources\paymentResource;
use App\Http\Resources\ServiceResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\SubServiceResorce;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\forgotResponseMail;


class ApiServiceController extends Controller
{
    public function services()
    {
        $services = main_service::all();
        return ServiceResource::collection($services);
    }

    public function show_service($id)
    {
        $service = main_service::findOrFail($id);
        return new ServiceResource($service);
    }

    public function sub_services()
    {
        $services = sub_service::all();
        return SubServiceResorce::collection($services);
    }

    public function show_sub_service($id)
    {
        $service = sub_service::findOrFail($id);
        return new SubServiceResorce($service);
    }

    public function order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'main_service_id' => ['required']
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                'error' => $validator->errors()->all(),
            ],409);
        }
        $main_service = main_service::where('id', $request->main_service_id)->first();
        $token = $request->header('Authorization');
        $user = User::where('access_token', $token)->first();
        $order_number = random_int(1000, 9999);
        if ($main_service) {
            $order = main_service_user::create([
                "user_id" => $user->id,
                "main_service_id" => $main_service->id,
                "order_number" => $order_number,
            ]);
            if ($order) {
                if ($order->main_services->id == 1) {
                    $validator = Validator::make($request->all(), [
                        "sub_service_id" => ['required']
                    ]);
                    if ($validator->fails()) {
                        $order->delete();
                        return response()->json([
                            "status" => false,
                            'error' => $validator->errors()->all(),
                        ],409);
                    }
                    $sub_service = sub_service::where('id', $request->sub_service_id)->first();
                    $sub_order = sub_service_user::create([
                        "user_id" => $user->id,
                        "sub_service_id" => $sub_service->id,
                        "order_number" => $order_number,
                    ]);
                    if ($sub_order) {
                        // return response()->json([
                        //     "status" => true,
                        //     "data" => new orderResource($order),
                        //     "message" => "success"
                        // ]);
                        if ($sub_order->sub_services->id == 1) {
                            $validator = Validator::make($request->all(), [
                                "id_photo_from" => ['required', 'max:20000'],
                                "driving_license_from" => ['required', 'max:20000'],
                                "others_from" => ['nullable', 'max:20000'],
                                "id_photo_to" => ['required', 'max:20000'],
                                "driving_license_to" => ['required', 'max:20000'],
                                "others_to" => ['nullable', 'max:20000'],

                            ]);
                            if ($validator->fails()) {
                                $order->delete();
                                $sub_order->delete();
                                return response()->json([
                                    "status" => false,
                                    'error' => $validator->errors()->all(),
                                ],409);
                            }
                            $path_id_photo_from = $request->file('id_photo_from')->store('files');
                            $path_driving_license_from = $request->file('driving_license_from')->store('files');
                            $path_id_photo_to = $request->file('id_photo_to')->store('files');
                            $path_driving_license_to = $request->file('driving_license_to')->store('files');

                            if ($request->hasfile('others_from') and $request->hasfile('others_to')) {
                                $path_others_from = $request->file('others_from')->store('files');
                                $path_others_to = $request->file('others_to')->store('files');
                                $pTOp = P2P_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "id_photo_from" => $path_id_photo_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "others_from" => $path_others_from,
                                    "id_photo_to" => $path_id_photo_to,
                                    "driving_license_to" => $path_driving_license_to,
                                    "others_to" => $path_others_to,
                                ]);
                                if ($pTOp) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "error" => ["add files failed"],
                                    ],409);
                                }
                            } elseif ($request->hasfile('others_from')) {
                                $path_others_from = $request->file('others_from')->store('files');
                                $pTOp = P2P_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "id_photo_from" => $path_id_photo_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "others_from" => $path_others_from,
                                    "id_photo_to" => $path_id_photo_to,
                                    "driving_license_to" => $path_driving_license_to,
                                ]);
                                if ($pTOp) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "error" => ["add files failed"]
                                    ],409);
                                }
                            } elseif ($request->hasfile('others_to')) {
                                $path_others_to = $request->file('others_to')->store('files');
                                $pTOp = P2P_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "id_photo_from" => $path_id_photo_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "id_photo_to" => $path_id_photo_to,
                                    "driving_license_to" => $path_driving_license_to,
                                    "others_to" => $path_others_to,
                                ]);
                                if ($pTOp) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "errror" => ["add files failed"]
                                    ]);
                                }
                            } else {
                                $pTOp = P2P_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "id_photo_from" => $path_id_photo_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "id_photo_to" => $path_id_photo_to,
                                    "driving_license_to" => $path_driving_license_to,
                                ]);
                                if ($pTOp) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "error" => ["add files failed"]
                                    ],409);
                                }
                            }
                        } elseif ($sub_order->sub_services->id == 2) {
                            $validator = Validator::make($request->all(), [
                                "log_image_from" => ['required', 'max:20000'],
                                "letter_from" => ['required', 'max:20000'],
                                "driving_license_from" => ['required', 'max:20000'],
                                "others_from" => ['nullable', 'max:20000'],
                                "log_image_to" => ['required', 'max:20000'],
                                "letter_to" => ['required', 'max:20000'],
                                "driving_license_to" => ['required', 'max:20000'],
                                "others_to" => ['nullable', 'max:20000'],
                            ]);
                            if ($validator->fails()) {
                                $order->delete();
                                $sub_order->delete();
                                return response()->json([
                                    "status" => false,
                                    'error' => $validator->errors()->all(),
                                ],409);
                            }
                            $path_log_image_from = $request->file('log_image_from')->store('files');
                            $path_letter_from = $request->file('letter_from')->store('files');
                            $path_driving_license_from = $request->file('driving_license_from')->store('files');
                            $path_log_image_to = $request->file('log_image_to')->store('files');
                            $path_letter_to = $request->file('letter_to')->store('files');
                            $path_driving_license_to = $request->file('driving_license_to')->store('files');
                            if ($request->hasfile('others_from') and $request->hasfile('others_to')) {
                                $path_others_from = $request->file('others_from')->store('files');
                                $path_others_to = $request->file('others_to')->store('files');
                                $cTOc = C2C_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "log_image_from" => $path_log_image_from,
                                    "letter_from" => $path_letter_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "others_from" => $path_others_from,
                                    "log_image_to" => $path_log_image_to,
                                    "letter_to" => $path_letter_to,
                                    "driving_license_to" => $path_driving_license_to,
                                    "others_to" => $path_others_to,
                                ]);
                                if ($cTOc) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "error" => ["add files failed"]
                                    ],409);
                                }
                            } elseif ($request->hasfile('others_from')) {
                                $path_others_from = $request->file('others_from')->store('files');
                                $cTOc = C2C_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "log_image_from" => $path_log_image_from,
                                    "letter_from" => $path_letter_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "others_from" => $path_others_from,
                                    "log_image_to" => $path_log_image_to,
                                    "letter_to" => $path_letter_to,
                                    "driving_license_to" => $path_driving_license_to,
                                ]);
                                if ($cTOc) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "error" => ["add files failed"]
                                    ],409);
                                }
                            } elseif ($request->hasfile('others_to')) {
                                $path_others_to = $request->file('others_to')->store('files');
                                $cTOc = C2C_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "log_image_from" => $path_log_image_from,
                                    "letter_from" => $path_letter_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "log_image_to" => $path_log_image_to,
                                    "letter_to" => $path_letter_to,
                                    "driving_license_to" => $path_driving_license_to,
                                    "others_to" => $path_others_to,
                                ]);
                                if ($cTOc) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "error" => ["add files failed"]
                                    ],409);
                                }
                            } else {
                                $cTOc = C2C_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "log_image_from" => $path_log_image_from,
                                    "letter_from" => $path_letter_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "log_image_to" => $path_log_image_to,
                                    "letter_to" => $path_letter_to,
                                    "driving_license_to" => $path_driving_license_to,
                                ]);
                                if ($cTOc) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "error" => ["add files failed"]
                                    ],409);
                                }
                            }
                        } elseif ($sub_order->sub_services->id == 3) {
                            $validator = Validator::make($request->all(), [
                                "id_photo_from" => ['required', 'max:20000'],
                                "driving_license_from" => ['required', 'max:20000'],
                                "others_from" => ['nullable', 'max:20000'],
                                "log_image_to" => ['required', 'max:20000'],
                                "letter_to" => ['required', 'max:20000'],
                                "driving_license_to" => ['required', 'max:20000'],
                                "others_to" => ['nullable', 'max:20000'],
                            ]);
                            if ($validator->fails()) {
                                $order->delete();
                                $sub_order->delete();
                                return response()->json([
                                    "status" => false,
                                    'error' => $validator->errors()->all(),
                                ],409);
                            }
                            $path_id_photo_from = $request->file('id_photo_from')->store('files');
                            $path_driving_license_from = $request->file('driving_license_from')->store('files');
                            $path_log_image_to = $request->file('log_image_to')->store('files');
                            $path_letter_to = $request->file('letter_to')->store('files');
                            $path_driving_license_to = $request->file('driving_license_to')->store('files');
                            if ($request->hasfile('others_from') and $request->hasfile('others_to')) {
                                $path_others_from = $request->file('others_from')->store('files');
                                $path_others_to = $request->file('others_to')->store('files');
                                $pTOc = P2C_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "id_photo_from" => $path_id_photo_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "others_from" => $path_others_from,
                                    "log_image_to" => $path_log_image_to,
                                    "letter_to" => $path_letter_to,
                                    "driving_license_to" => $path_driving_license_to,
                                    "others_to" => $path_others_to,
                                ]);
                                if ($pTOc) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "error" => ["add files failed"]
                                    ],409);
                                }
                            } elseif ($request->hasfile('others_from')) {
                                $path_others_from = $request->file('others_from')->store('files');
                                $pTOc = P2C_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "id_photo_from" => $path_id_photo_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "others_from" => $path_others_from,
                                    "log_image_to" => $path_log_image_to,
                                    "letter_to" => $path_letter_to,
                                    "driving_license_to" => $path_driving_license_to,
                                ]);
                                if ($pTOc) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "error" => ["add files failed"]
                                    ],409);
                                }
                            } elseif ($request->hasfile('others_to')) {
                                $path_others_to = $request->file('others_to')->store('files');
                                $pTOc = P2C_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "id_photo_from" => $path_id_photo_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "log_image_to" => $path_log_image_to,
                                    "letter_to" => $path_letter_to,
                                    "driving_license_to" => $path_driving_license_to,
                                    "others_to" => $path_others_to,
                                ]);
                                if ($pTOc) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "error" => ["add files failed"]
                                    ],409);
                                }
                            } else {
                                $pTOc = P2C_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "id_photo_from" => $path_id_photo_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "log_image_to" => $path_log_image_to,
                                    "letter_to" => $path_letter_to,
                                    "driving_license_to" => $path_driving_license_to,
                                ]);
                                if ($pTOc) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "error" => ["add files failed"]
                                    ],409);
                                }
                            }
                        } else {
                            $validator = Validator::make($request->all(), [
                                "log_image_from" => ['required', 'max:20000'],
                                "letter_from" => ['required', 'max:20000'],
                                "driving_license_from" => ['required', 'max:20000'],
                                "others_from" => ['nullable', 'max:20000'],
                                "id_photo_to" => ['required', 'max:20000'],
                                "driving_license_to" => ['required', 'max:20000'],
                                "others_to" => ['nullable', 'max:20000'],
                            ]);
                            if ($validator->fails()) {
                                $order->delete();
                                $sub_order->delete();
                                return response()->json([
                                    "status" => false,
                                    'error' => $validator->errors()->all(),
                                ],409);
                            }
                            $path_log_image_from = $request->file('log_image_from')->store('files');
                            $path_letter_from = $request->file('letter_from')->store('files');
                            $path_driving_license_from = $request->file('driving_license_from')->store('files');
                            $path_id_photo_to = $request->file('id_photo_to')->store('files');
                            $path_driving_license_to = $request->file('driving_license_to')->store('files');
                            if ($request->hasfile('others_from') and $request->hasfile('others_to')) {
                                $path_others_from = $request->file('others_from')->store('files');
                                $path_others_to = $request->file('others_to')->store('files');
                                $cTOp = C2P_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "log_image_from" => $path_log_image_from,
                                    "letter_from" => $path_letter_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "others_from" => $path_others_from,
                                    "id_photo_to" => $path_id_photo_to,
                                    "driving_license_to" => $path_driving_license_to,
                                    "others_to" => $path_others_to,
                                ]);
                                if ($cTOp) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "error" => ["add files failed"]
                                    ],409);
                                }
                            } elseif ($request->hasfile('others_from')) {
                                $path_others_from = $request->file('others_from')->store('files');
                                $cTOp = C2P_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "log_image_from" => $path_log_image_from,
                                    "letter_from" => $path_letter_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "others_from" => $path_others_from,
                                    "id_photo_to" => $path_id_photo_to,
                                    "driving_license_to" => $path_driving_license_to,
                                ]);
                                if ($cTOp) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "error" => ["add files failed"]
                                    ],409);
                                }
                            } elseif ($request->hasfile('others_to')) {
                                $path_others_to = $request->file('others_to')->store('files');
                                $cTOp = C2P_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "log_image_from" => $path_log_image_from,
                                    "letter_from" => $path_letter_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "id_photo_to" => $path_id_photo_to,
                                    "driving_license_to" => $path_driving_license_to,
                                    "others_to" => $path_others_to,
                                ]);
                                if ($cTOp) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "error" => ["add files failed"]
                                    ],409);
                                }
                            } else {
                                $cTOp = C2P_service::create([
                                    "user_id" => $user->id,
                                    "subOrder_id" => $sub_order->id,
                                    "log_image_from" => $path_log_image_from,
                                    "letter_from" => $path_letter_from,
                                    "driving_license_from" => $path_driving_license_from,
                                    "id_photo_to" => $path_id_photo_to,
                                    "driving_license_to" => $path_driving_license_to,
                                ]);
                                if ($cTOp) {
                                    return response()->json([
                                        "status" => true,
                                        "message" => "add files successfuly",
                                        "data" => new orderResource($order),
                                    ]);
                                } else {
                                    $order->delete();
                                    $sub_order->delete();
                                    return response()->json([
                                        "status" => false,
                                        "error" => ["add files failed"]
                                    ],409);
                                }
                            }
                        }
                    } else {
                        $order->delete();
                        return response()->json([
                            "status" => false,
                            "error" => ["choose sub service"]
                        ],409);
                    }
                } elseif ($order->main_services->id == 2) {
                    $validator = Validator::make($request->all(), [
                        "id_photo" => ['required', 'max:20000'],
                        "form" => ['required', 'max:20000'],
                        "examination" => ['required', 'max:20000'],
                        "others" => ['nullable', 'max:20000'],
                    ]);
                    if ($validator->fails()) {
                        $order->delete();
                        return response()->json([
                            "status" => false,
                            'error' => $validator->errors()->all(),
                        ],409);
                    }
                    $path_id_photo = $request->file('id_photo')->store('files');
                    $path_form = $request->file('form')->store('files');
                    $path_examination = $request->file('examination')->store('files');
                    if ($request->hasfile('others')) {
                        $path_other = $request->file('others')->store('files');
                        $store = new_service::create([
                            "user_id" => $user->id,
                            "order_id" => $order->id,
                            "id_photo" => $path_id_photo,
                            "form" => $path_form,
                            "Examination" => $path_examination,
                            "others" => $path_other,
                        ]);
                        if ($store) {
                            return response()->json([
                                "status" => true,
                                "message" => "add files successfuly",
                                "data" => new orderResource($order)
                            ]);
                        } else {
                            $order->delete();
                            return response()->json([
                                "status" => false,
                                "error" => ["add files failed"]
                            ],409);
                        }
                    } else {
                        $store = new_service::create([
                            "user_id" => $user->id,
                            "order_id" => $order->id,
                            "id_photo" => $path_id_photo,
                            "form" => $path_form,
                            "Examination" => $path_examination,
                        ]);
                        if ($store) {
                            return response()->json([
                                "status" => true,
                                "message" => "add files successfuly",
                                "data" => new orderResource($order),
                            ]);
                        } else {
                            $order->delete();
                            return response()->json([
                                "status" => false,
                                "error" => ["add files failed"]
                            ],409);
                        }
                    }
                } else {
                    $validator = Validator::make($request->all(), [
                        "id_photo" => ['required', 'max:20000'],
                        "form" => ['required', 'max:20000'],
                        "others" => ['nullable', 'max:20000'],
                    ]);
                    if ($validator->fails()) {
                        $order->delete();
                        return response()->json([
                            "status" => false,
                            'error' => $validator->errors()->all(),
                        ],409);
                    }
                    $path_id_photo = Storage::disk('uploads')->put("files",$request->id_photo);
                    $path_form = Storage::disk('uploads')->put("files",$request->form);
                    if ($request->hasfile('others')) {
                        $path_other = $request->file('others')->store('files');
                        $store = insurance_service::create([
                            "user_id" => $user->id,
                            "order_id" => $order->id,
                            "id_photo" => $path_id_photo,
                            "form" => $path_form,
                            "others" => $path_other,
                        ]);
                        if ($store) {
                            return response()->json([
                                "status" => true,
                                "message" => "add files successfuly",
                                "data" => new orderResource($order)
                            ]);
                        } else {
                            $order->delete();
                            return response()->json([
                                "status" => false,
                                "error" => ["add files failed"]
                            ],409);
                        }
                    } else {
                        $store = insurance_service::create([
                            "user_id" => $user->id,
                            "order_id" => $order->id,
                            "id_photo" => $path_id_photo,
                            "form" => $path_form,
                        ]);
                        if ($store) {
                            return response()->json([
                                "status" => true,
                                "message" => "add files successfuly",
                                "data" => new orderResource($order)
                            ]);

                        } else {
                            $order->delete();
                            return response()->json([
                                "status" => false,
                                "error" => ["add files failed"]
                            ],409);
                        }
                    }
                }
            } else {
                return response()->json([
                    "status" => false,
                    "error" => ["order process failed"]
                ],409);
            }
        } else {
            return response()->json([
                "status" => false,
                "error" => ["choose main service"]
            ],409);
        }
    }
    public function orders(Request $request){
        $token = $request->header('Authorization');
        $user = User::where('access_token', $token)->first();
        $orders = main_service_user::where("user_id",$user->id)->get();
        return orderResource::collection($orders);
    }
    public function payment(Request $request,$order_number,$device_token){
        $token = $request->header('Authorization');
        $user = User::where('access_token', $token)->first();
        $order = main_service_user::where("order_number",$order_number)->first();
        $validator = Validator::make($request->all(), [
            'payment_receipt' => ['required','image']
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                'error' => $validator->errors()->all(),
            ],409);
        }
        // $payment_receipt = $request->file('payment_receipt')->store('payment_receipt');
        $payment_receipt = Storage::disk('uploads')->put("payment_receipt",$request->payment_receipt);

        $payment = payment::create([
            "user_id" =>$user->id,
            "order_number"=>$order_number,
            "payment_receipt"=>$payment_receipt
        ]);
        if($payment){
            $notify = new ApiNotifation;
            // $device_token = $request->device_token;
            $device_token = $device_token;
            $notify->sendNotification($device_token,"payment","Payment process success");
            $order->update([
                "status" => "pendingOTPConfirmation",
            ]);
            $otp = random_int(1000, 9999);
            $payment->update([
                'remember_token' => $otp,
            ]);
            Mail::to($user->email)->send(new forgotResponseMail($otp));

<<<<<<< HEAD
            Mail::to($user->email)->send(new forgotResponseMail($otp));

            // $basic  = new \Vonage\Client\Credentials\Basic("5fda2890", "d8oQEEVeAmQ5EfkT");
            // $client = new \Vonage\Client($basic);

=======
            // $basic  = new \Vonage\Client\Credentials\Basic("5fda2890", "d8oQEEVeAmQ5EfkT");
            // $client = new \Vonage\Client($basic);

>>>>>>> 6812f19be9f30f713fd59d76317d350a33d89878
            // $response = $client->sms()->send(
            //     new \Vonage\SMS\Message\SMS("2$user->phone", "15556666666", "Your OTP is $otp for verification")
            // );
            // $message = $response->current();

            return response()->json([
                "status"=>true,
                "message"=>"Payment process success",
                "data" => new paymentResource($payment)
            ]);
        }else{
            return response()->json([
                "status"=>false,
                "error"=>["Payment process failed"]
            ],409);
        }
    }
    public function paymentotp($paymentOTP)
    {
        $user = payment::where('remember_token', $paymentOTP)->first();
        if ($user !== Null) {
            $order = main_service_user::where("order_number",$user->order_number)->first();
            $order->update([
                "status" => "otpConfirmed",
            ]);
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ], 409);
        }
    }

    public function orderFiles($order_number){
        $orderFiles = admin_main_upload::where('order_number', $order_number)->select('admin_uploads')->get();
        if($orderFiles){
            return response()->json([
                "status"=>true,
                "data"=> $orderFiles
            ]);
        }else{
            return response()->json([
                "status"=>false,
                "error"=>["Order Number not valid"]
            ],409);
        }
    }

}
