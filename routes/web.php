<?php

use App\Http\Controllers\API\OAuthController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\AuthController;
use App\Http\Controllers\dashboard\UserController;
use App\Http\Controllers\dashboard\UploadController;
use App\Http\Controllers\dashboard\ServiceController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\LangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [AuthController::class,'loginform']);
Route::post('/login',[AuthController::class,'login']);
// Route::get('/logout',[AuthController::class,'logout']);

Route::get('/forget',[AuthController::class,'forget']);
Route::post('/forget-pass',[AuthController::class,'authPhone']);
Route::get('/reset_route',[AuthController::class,'reset_route']);
Route::post('/reset-password',[AuthController::class,'reset']);

Route::get('/logout',[AuthController::class,'logout']);

Route::get('/send',[Controller::class,'send']);
Route::get('/lang/set/{lang}', [LangController::class , 'set']);

Route::middleware('lang')->group(function() {


    Route::prefix('/')->group(function() {
        Route::view('home', 'home')->name('home');
        Route::post('/get-token', [OAuthController::class, 'deGenerateToken'])->name('generate.token');
        Route::get('/get-token', [OAuthController::class, 'doSuccessToken'])->name('token.success');
        Route::post('/send', [MailController::class, 'doSendEmail'])->name('send.email');
    });
    
    
    Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth','can-enter-dashboard']);
    
    Route::prefix('dashboard')->middleware(['auth','can-enter-dashboard'])->group(function () {
        Route::get('/services',[ServiceController::class,'index']);
        Route::get('/services/{main_id}',[ServiceController::class,'subservice']);
        Route::get('/services/show/{main_id}',[ServiceController::class,'show']);
    
        Route::get('/services/main_edit/{main_id}',[ServiceController::class,'main_edit']);
        Route::get('/services/main_update/{main_id}',[ServiceController::class,'main_update']);
    
    
        Route::get('/services/sub_edit/{sub_id}',[ServiceController::class,'sub_edit']);
        Route::get('/services/sub_update/{sub_id}',[ServiceController::class,'sub_update']);
    
    
    
        Route::get('/users',[UserController::class,'index']);
        Route::get('/users/{user_id}',[UserController::class,'show_orders']);
        Route::get('/users/orders/{order_id}',[UserController::class,'show_order_details']);
        Route::get('/users/adminUpload/{order_id}',[UserController::class,'adminUpload']);
        Route::post('/users/storeUploads/{order_id}',[UserController::class,'storeUploads']);
    
        Route::get('/users/payment/{user_id}',[UserController::class,'payment']);
    
        Route::get('/uploads',[UploadController::class,'index']);
        Route::get('/uploads/delete/{upload_id}',[UploadController::class,'delete']);
    
    
        Route::get('/users/pendingPayment/{order_id}',[UserController::class,'pendingPayment']);
        Route::get('/users/pendingOTPConfirmation/{order_id}',[UserController::class,'pendingOTPConfirmation']);
        // Route::get('/users/otpConfirmed/{order_id}',[UserController::class,'otpConfirmed']);
        Route::get('/users/completed/{order_id}',[UserController::class,'completed']);
    
    
       
    
    
    
    
    
    
    });




});



