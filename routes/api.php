<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiAuthController;
use App\Http\Controllers\API\ApiForgetController;
use App\Http\Controllers\API\ApiProfileController;
use App\Http\Controllers\API\ApiServiceController;
use App\Http\Controllers\API\OAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login',[ApiAuthController::class,'login']);
Route::post('/register',[ApiAuthController::class,'register']);

Route::post('/forget',[ApiForgetController::class,'forgot']);

Route::post('/otp/{otp}',[ApiForgetController::class,'otp']);
Route::post('/reset/{otp}',[ApiForgetController::class,'reset']);

Route::get('/get-profile',[ApiProfileController::class,'get'])->middleware('Api-auth');
Route::post('/update-profile',[ApiProfileController::class,'update'])->middleware('Api-auth');
Route::post('/change-password',[ApiProfileController::class,'change'])->middleware('Api-auth');

Route::post('/logout',[ApiAuthController::class,'logout'])->middleware('Api-auth');

Route::post('/send',[Controller::class,'send']);




Route::get('/services', [ApiServiceController::class,'services']);
Route::get('/services/{id}', [ApiServiceController::class , 'show_service']);
Route::get('/sub_services', [ApiServiceController::class,'sub_services']);
Route::get('/sub_services/{id}', [ApiServiceController::class , 'show_sub_service']);

Route::post('/recive_order', [ApiServiceController::class,'order'])->middleware('Api-auth');
Route::post('/orders', [ApiServiceController::class,'orders'])->middleware('Api-auth');
Route::post('/payment/{order_number}/{device_token}', [ApiServiceController::class,'payment'])->middleware(['Api-auth']);
Route::post('/paymentotp/{paymentOTP}', [ApiServiceController::class,'paymentotp'])->middleware(['Api-auth']);
Route::post('/orderFiles/{order_number}', [ApiServiceController::class,'orderFiles'])->middleware(['Api-auth']);
// Route::post('/firstPartyUploads', [ApiServiceController::class,'firstPartyUploads'])->middleware(['Api-auth','Api-order']);
// Route::post('/secondPartyUploads', [ApiServiceController::class,'secondPartyUploads'])->middleware(['Api-auth','Api-order']);
