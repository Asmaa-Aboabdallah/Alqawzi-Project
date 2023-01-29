<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\services\FatoorahServices;
use App\Models\main_service_user;

class ApiFatoorahController extends Controller
{
    private $fatoorahServices;
    public function __construct(FatoorahServices $fatoorahServices)
    {
        $this->fatoorahServices = $fatoorahServices;
    }
    public function checkout(Request $request) 
    {

        $token = $request->header('Authorization');
        $user = User::where('access_token',$token)->first();

        $orders = main_service_user::where('user_id',$user->id)->where('status',"pendingPayment")->all();
        $price = 0;
        foreach($orders as $order){
            $price += $order->main_services->price;
        }

        // $fatoorahServices = new FatoorahServices($user->id);
        // $payment = new payments();

        $data = [
            "CustomerName" => $user->name,
            "Notificationoption" => "LNK",
            "Invoicevalue" => $price, // total_price
            // "CustomerEmail" => 'customer_email',
            "CalLBackUrl" => 'https://domain.com/callback',
            "Errorurl" => 'https://domain.com/error',
            "Languagn" => 'en',
            "DisplayCurrencyIna" => 'SAR'
        ];
        $response = $this->fatoorahServices->sendPayment($data);

        if (isset($response['IsSuccess']))
            if ($response['IsSuccess'] == true) {

                $InvoiceId  = $response['Data']['InvoiceId']; // save this id with your order table
                $InvoiceURL = $response['Data']['InvoiceURL'];
            }
        return redirect($response['Data']['InvoiceURL']); // redirect for this link to view payment page
    }
    //request
    // {
    //     "CustomerName": "name",
    //     "NotificationOption": "ALL",
    //     "MobileCountryCode": "965",
    //     "CustomerMobile": "12345678",
    //     "CustomerEmail": "mail@company.com",
    //     "InvoiceValue": 100,
    //     "DisplayCurrencyIso": "kwd",
    //     "CallBackUrl": "https://yoursite.com/success",
    //     "ErrorUrl": "https://yoursite.com/error",
    //     "Language": "en",
    //     "CustomerReference": "noshipping-nosupplier",
    //     "CustomerAddress": {
    //       "Block": "string",
    //       "Street": "string",
    //       "HouseBuildingNo": "string",
    //       "Address": "address",
    //       "AddressInstructions": "string"
    //     },
    //     "InvoiceItems": [
    //       {
    //         "ItemName": "string",
    //         "Quantity": 20,
    //         "UnitPrice": 5
    //       }
    //     ]
    //   }



    //response
    // {
    //     "IsSuccess": true,
    //     "Message": "Invoice Created Successfully!",
    //     "ValidationErrors": null,
    //     "Data": {
    //         "InvoiceId": 300034,
    //         "InvoiceURL": "https://demo.myfatoorah.com/ie/0106230003434",
    //         "CustomerReference": "noshipping-nosupplier",
    //         "UserDefinedField": null
    //     }
    // }



    public function callback(Request $request)
    {
        $apiKey = 'your_token_on_myfatoorah';
        $postFields = [
            'Key'     => $request->paymentId,
            'KeyType' => 'paymentId'
        ];
        $response = $this->fatoorahServices->callAPI("https://apitest.myfatoorah.com/v2/getPaymentStatus", $apiKey, $postFields);
        $response = json_decode($response);
        if (!isset($response->Data->InvoiceId))
            return response()->json(["error" => 'error', 'status' => false], 404);
        $InvoiceId =  $response->Data->InvoiceId; // get your order by payment_id
        // $payment = OrderPayment::where('invoice',$InvoiceId)->first();
        if ($response->IsSuccess == true) {
            // if ($response->Data->InvoiceStatus == "Paid") { //||$response->Data->InvoiceStatus=='Pending'
            //     if ($payment->price == $response->Data->InvoiceValue) {

            //         /**
            //          *
            //          * The payment has been completed successfully. You can change the status of the order
            //          *
            //          */
            //     }
            // }
        }

        return response()->json(["error" => 'error', 'status' => false], 404);
    }
}
