<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    //--register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'email' =>'email|required|unique:users,email',
            'password' => 'required|confirmed'
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()
            ],422);
        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            if($user){
                return response()->json([
                    'status' => 200,
                    'message' => "New User Created Successfully",
                    'data' => $user,
                    'token' => $user->createToken('Api Token Of '. $user->name)->plainTextToken
                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "User Created Failed.Please Try Again!",
                ],404);
            }
        }
    }

    //---login_view
    public function login_view()
    {
        return response()->json([
            'status' => 500,
            'message' => 'Internal Server Error'
        ], 500);
    }
    //--login
    public function login(LoginRequest $request)
    {
        $validated = $request->validated($request->all());
        if(!auth()->attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => 401,
                'message' => "Credentails do not Match!"
            ], 401);
        }else{
            $user = Auth::user();
            if($user){
                return response()->json([
                    'status' => 200,
                    'message' => 'User Login Successfully',
                    'data' => $user,
                    'token' => $user->createToken('Api Token Of '. $user->name)->plainTextToken
                ], 200);
            }
        }
    }

    //---logout
    public function logout()
    {
         auth()->user()->currentAccessToken()->delete();
         return response()->json([
            'status' => 200,
            'message' => 'User Logout Successfully'
        ], 200);
    
    }
}
