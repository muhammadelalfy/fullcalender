<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{
    public function registerUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'              => 'required|string',
            'email'              => 'required|unique:users,email',
            'phone'             => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users,phone',
            'password'          => 'required|string|min:3',
            'google_token'      => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 200);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            [
                'password' => bcrypt($request->password),
                'code' => rand(1111, 9999),
            ]
        ));
        $token = JWTAuth::fromUser($user);
        return response()->json([
            'status' => 'success',
            'user_id' => $user->id,
            'phone' => $user->phone,
            'code' => $user->code,
            'token' => $token
        ], 200);
    }
    public function verifyCode(Request $request)
    {
        $rules = [
            'user_id'    => 'required',
            'code'     => 'required|min:4',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response()->json([
                'status'=>'error',
                'errors'=>$validator->errors()
            ],200);
        $user = User::where(['code'=> $request->code,'id'=>$request->user_id])->first();
        if (!$user)
            return response()->json([
                'status' => 'error',
                'message' => 'Error Data'
            ], 200);
        $user->isVerified = 1;
        $user->save();
        Auth::login($user->first());
        return response()->json([
            'status' => 'success',
            'message' => 'Phone number verified!'
        ], 200);
    }
    public function resetCode(Request $request)
    {
        $rules = [
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|exists:users,phone',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status'=>'error',
                'errors'=>$validator->errors()
            ],200);
        }
        $user = User::where('phone', $request->phone)->first();
        //dd($user);
        if ($user) {
            return response()->json([
                'status' => 'success',
                'user_id' =>  $user->id,
                'phone' => $user->phone,
                'code' => $user->code
            ], 200);
        }
    }

    public function loginUser(Request $request)
    {
        $rules = [
            'phone'     => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'password'  => 'required|string',
            'google_token' => 'nullable|string'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $credentials = request(['phone', 'password']);

        if (!Auth::attempt($credentials)) {

            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 200);
        } elseif (auth()->user()->isVerified == false) {

            return response()->json([
                'message' => 'not verfiy',
                'user_id' => auth()->user()->id,
            ], 200);
        } elseif (auth()->user()->isVerified == true) {

            $user = $request->user();
            $user->update(['google_token' => $request->google_token]);
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'status' => 'success',
                'message' => 'you are logged in',
                'user_id' => auth()->user()->id,
                'type' => 'user',
                'token' => $token,
                'google_token' => $user->google_token,
                'token_type' => 'Bearer',
            ], 200);
        }
    }

    public function forgetPassword(Request $request)
    {

        $data = $request->validate([
            'code' => 'required|numeric',
            'password' => 'required|string|min:3',
            'confirm_password' => 'required|string|min:3',
        ]);

        $user = User::where('code', $data['code'])->first();

        $user->update([
            'password' => bcrypt($request->password),
        ]);

        $user->save();

        if ($user) {
            return response()->json([
                'status' => 'success',
                'message' => 'Password Updated'
            ], 200);
        }
    }

    public function userData()
    {
        $user = auth()->user();
        return response()->json([
            'status' =>  'success',
            'user_id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'code' => $user->code,
            'active' => $user->status,
        ], 200);
    }
    public function logout()
    {
        auth()->logout();

        return response()->json([
            'status' => 'success',
            'message' => 'User successfully signed out'
        ], 200);
    }

    public function updateUser(Request $request)
    {
        $rules = [
            'name' => 'nullable',
            'password' => 'nullable',
            'phone'     => 'nullable',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status'=>'error',
                'errors'=>$validator->errors()
            ],200);
        }
        $user = User::where('id',auth()->user()->id)->first();
        $user->name   = $request->input('name') ? $request->input('name') : $user->name;
        $user->phone   =  $request->input('phone') ? $request->input('phone') : $user->phone;
        $user->password = bcrypt($request->password);
        $user->save();
        if($user){
            return response()->json([
            'status' => 'success',
            'message' => 'profile updated successfully',
        ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'error',
            ], 200);
        }
    }
}
