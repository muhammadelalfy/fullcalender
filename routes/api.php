<?php


// in headers 'Accept-Language'=>['ar','en']


use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// register
Route::post('register',[AuthController::class,'registerUser']);
Route::post('verifycode',[AuthController::class,'verifyCode']);
Route::post('resendcode',[AuthController::class,'resetCode']);
Route::post('forgetpassword',[AuthController::class,'forgetPassword']);
Route::post('login',[AuthController::class,'loginUser']);
// end register
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('user',[AuthController::class,'userData']);
    Route::post('update-user',[AuthController::class,'updateUser']);


    Route::get('logout', [AuthController::class, 'logout']);
});
